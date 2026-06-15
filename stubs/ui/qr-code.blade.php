{{--
    QR Code — a client-side QR code generator rendered as crisp SVG.

      value   the text/URL to encode (byte mode, UTF-8)
      size    rendered width/height in px (default 160)
      ecc     error-correction level: L | M | Q | H (default M)
      margin  quiet-zone width in modules (default 4 — the QR spec minimum)
      alt     accessible label; defaults to "QR code for {value}"

    The module matrix is computed entirely in the browser by a small, dependency-free
    QR encoder (a compact port of Nayuki's public-domain QR-Code-generator). It supports
    full byte mode over UTF-8, Reed–Solomon ECC over GF(256), automatic version selection
    (1–40), all four ECC levels, and applies the lowest-penalty mask with correct format
    and version information — i.e. it produces standard, scannable QR codes.

    The engine is registered as an Alpine component in the @once <script> below (NOT inside
    an x-data attribute) so the encoder's string/byte literals aren't mangled by HTML
    attribute decoding.

    Theming: dark modules paint with `currentColor` (inherits text-foreground), the
    quiet-zone/background uses bg-background — so the code follows light/dark themes.
    Override the module colour with a Tailwind text-* utility on the component (e.g.
    class="text-emerald-600") and the background by layering a bg-* utility.

    A11y: the <svg> is role="img" with an aria-label, so screen readers announce it as a
    single image. The layout uses no physical-direction assumptions (RTL-safe).
--}}
@props([
    'value' => '',
    'size' => 160,
    'ecc' => 'M',
    'margin' => 4,
    'alt' => null,
])

@php
    $eccLevel = in_array(strtoupper((string) $ecc), ['L', 'M', 'Q', 'H'], true) ? strtoupper((string) $ecc) : 'M';
    $label = $alt !== null ? $alt : ('QR code for ' . $value);
@endphp

@once
    <script>
        document.addEventListener('alpine:init', () => {
            // ---------------------------------------------------------------
            // Compact, dependency-free QR Code encoder.
            // Port of Nayuki's QR-Code-generator (public domain / MIT-0).
            // Byte mode, UTF-8, Reed–Solomon ECC over GF(256), versions 1–40,
            // automatic version + lowest-penalty mask selection.
            // Reference: https://www.nayuki.io/page/qr-code-generator-library
            // ---------------------------------------------------------------
            const QR = (() => {
                const ECC = {
                    // ordinal, formatBits
                    L: { ord: 0, bits: 1 },
                    M: { ord: 1, bits: 0 },
                    Q: { ord: 2, bits: 3 },
                    H: { ord: 3, bits: 2 },
                };

                // Number of error-correction codewords per block, indexed [eccOrd][version]
                const ECC_CODEWORDS_PER_BLOCK = [
                    // version: 0(unused) 1  2  3  4  5  6  7  8  9 10 11 12 13 14 15 16 17 18 19 20 21 22 23 24 25 26 27 28 29 30 31 32 33 34 35 36 37 38 39 40
                    [-1, 7, 10, 15, 20, 26, 18, 20, 24, 30, 18, 20, 24, 26, 30, 22, 24, 28, 30, 28, 28, 28, 28, 30, 30, 26, 28, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30], // L
                    [-1, 10, 16, 26, 18, 24, 16, 18, 22, 22, 26, 30, 22, 22, 24, 24, 28, 28, 26, 26, 26, 26, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28, 28], // M
                    [-1, 13, 22, 18, 26, 18, 24, 18, 22, 20, 24, 28, 26, 24, 20, 30, 24, 28, 28, 26, 30, 28, 30, 30, 30, 30, 28, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30], // Q
                    [-1, 17, 28, 22, 16, 22, 28, 26, 26, 24, 28, 24, 28, 22, 24, 24, 30, 28, 28, 26, 28, 30, 24, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30, 30], // H
                ];
                const NUM_ERROR_CORRECTION_BLOCKS = [
                    [-1, 1, 1, 1, 1, 1, 2, 2, 2, 2, 4, 4, 4, 4, 4, 6, 6, 6, 6, 7, 8, 8, 9, 9, 10, 12, 12, 12, 13, 14, 15, 16, 17, 18, 19, 19, 20, 21, 22, 24, 25], // L
                    [-1, 1, 1, 1, 2, 2, 4, 4, 4, 5, 5, 5, 8, 9, 9, 10, 10, 11, 13, 14, 16, 17, 17, 18, 20, 21, 23, 25, 26, 28, 29, 31, 33, 35, 37, 38, 40, 43, 45, 47, 49], // M
                    [-1, 1, 1, 2, 2, 4, 4, 6, 6, 8, 8, 8, 10, 12, 16, 12, 17, 16, 18, 21, 20, 23, 23, 25, 27, 29, 34, 34, 35, 38, 40, 43, 45, 48, 51, 53, 56, 59, 62, 65, 68], // Q
                    [-1, 1, 1, 2, 4, 4, 4, 5, 6, 8, 8, 11, 11, 16, 16, 18, 16, 19, 21, 25, 25, 25, 34, 30, 32, 35, 37, 40, 42, 45, 48, 51, 54, 57, 60, 63, 66, 70, 74, 77, 81], // H
                ];

                // ---- Galois-field (GF(256)) arithmetic for Reed–Solomon ----
                function reedSolomonComputeDivisor(degree) {
                    if (degree < 1 || degree > 255) throw new RangeError('Degree out of range');
                    const result = [];
                    for (let i = 0; i < degree - 1; i++) result.push(0);
                    result.push(1); // monic, coefficients are stored from highest to lowest power
                    let root = 1;
                    for (let i = 0; i < degree; i++) {
                        for (let j = 0; j < result.length; j++) {
                            result[j] = reedSolomonMultiply(result[j], root);
                            if (j + 1 < result.length) result[j] ^= result[j + 1];
                        }
                        root = reedSolomonMultiply(root, 0x02);
                    }
                    return result;
                }
                function reedSolomonComputeRemainder(data, divisor) {
                    const result = divisor.map(() => 0);
                    for (const b of data) {
                        const factor = b ^ result.shift();
                        result.push(0);
                        divisor.forEach((coef, i) => (result[i] ^= reedSolomonMultiply(coef, factor)));
                    }
                    return result;
                }
                function reedSolomonMultiply(x, y) {
                    if (x >>> 8 !== 0 || y >>> 8 !== 0) throw new RangeError('Byte out of range');
                    let z = 0;
                    for (let i = 7; i >= 0; i--) {
                        z = (z << 1) ^ ((z >>> 7) * 0x11d);
                        z ^= ((y >>> i) & 1) * x;
                    }
                    return z & 0xff;
                }

                function getNumRawDataModules(ver) {
                    if (ver < 1 || ver > 40) throw new RangeError('Version out of range');
                    let result = (16 * ver + 128) * ver + 64;
                    if (ver >= 2) {
                        const numAlign = Math.floor(ver / 7) + 2;
                        result -= (25 * numAlign - 10) * numAlign - 55;
                        if (ver >= 7) result -= 36;
                    }
                    return result;
                }
                function getNumDataCodewords(ver, eccOrd) {
                    return (
                        Math.floor(getNumRawDataModules(ver) / 8) -
                        ECC_CODEWORDS_PER_BLOCK[eccOrd][ver] * NUM_ERROR_CORRECTION_BLOCKS[eccOrd][ver]
                    );
                }

                // ---- Bit buffer ----
                function appendBits(val, len, bb) {
                    if (len < 0 || len > 31 || val >>> len !== 0) throw new RangeError('Value out of range');
                    for (let i = len - 1; i >= 0; i--) bb.push((val >>> i) & 1);
                }

                // ---- UTF-8 encode a string to bytes ----
                function toUtf8(str) {
                    const out = [];
                    for (const ch of unescape(encodeURIComponent(str))) out.push(ch.charCodeAt(0));
                    return out;
                }

                // ---- Byte-mode segment ----
                function makeByteSegment(data) {
                    const bb = [];
                    for (const b of data) appendBits(b, 8, bb);
                    return { mode: 0x4, numChars: data.length, bitData: bb };
                }
                function getNumCharCountBits(ver) {
                    // byte mode char-count bits per version range
                    if (ver <= 9) return 8;
                    if (ver <= 26) return 16;
                    return 16;
                }

                // ---- Main encode ----
                function encode(text, eccKey) {
                    let eccOrd = ECC[eccKey].ord;
                    const data = toUtf8(text);
                    const seg = makeByteSegment(data);

                    // Choose the smallest version that fits at the requested ECC level.
                    let version;
                    for (version = 1; version <= 40; version++) {
                        const dataCapacityBits = getNumDataCodewords(version, eccOrd) * 8;
                        const usedBits = 4 + getNumCharCountBits(version) + seg.bitData.length;
                        if (usedBits <= dataCapacityBits) break;
                        if (version >= 40) throw new RangeError('Data too long');
                    }

                    const ccBits = getNumCharCountBits(version);
                    const bb = [];
                    appendBits(seg.mode, 4, bb);
                    appendBits(seg.numChars, ccBits, bb);
                    for (const bit of seg.bitData) bb.push(bit);

                    const dataCapacityBits = getNumDataCodewords(version, eccOrd) * 8;
                    // terminator
                    appendBits(0, Math.min(4, dataCapacityBits - bb.length), bb);
                    // pad to byte boundary
                    appendBits(0, (8 - (bb.length % 8)) % 8, bb);
                    // pad bytes
                    for (let padByte = 0xec; bb.length < dataCapacityBits; padByte ^= 0xec ^ 0x11)
                        appendBits(padByte, 8, bb);

                    // Pack bits into data codewords
                    const dataCodewords = [];
                    while (dataCodewords.length * 8 < bb.length) dataCodewords.push(0);
                    bb.forEach((bit, i) => (dataCodewords[i >>> 3] |= bit << (7 - (i & 7))));

                    return buildMatrix(version, eccOrd, dataCodewords);
                }

                // ---- Interleave ECC + lay out modules ----
                function buildMatrix(version, eccOrd, dataCodewords) {
                    const size = version * 4 + 17;
                    const numBlocks = NUM_ERROR_CORRECTION_BLOCKS[eccOrd][version];
                    const blockEccLen = ECC_CODEWORDS_PER_BLOCK[eccOrd][version];
                    const rawCodewords = Math.floor(getNumRawDataModules(version) / 8);
                    const numShortBlocks = numBlocks - (rawCodewords % numBlocks);
                    const shortBlockLen = Math.floor(rawCodewords / numBlocks);

                    // Split data into blocks and append ECC to each.
                    const blocks = [];
                    const rsDiv = reedSolomonComputeDivisor(blockEccLen);
                    for (let i = 0, k = 0; i < numBlocks; i++) {
                        const datLen = shortBlockLen - blockEccLen + (i < numShortBlocks ? 0 : 1);
                        const dat = dataCodewords.slice(k, k + datLen);
                        k += datLen;
                        const ecc = reedSolomonComputeRemainder(dat, rsDiv.slice());
                        if (i < numShortBlocks) dat.push(0); // placeholder for alignment
                        blocks.push(dat.concat(ecc));
                    }

                    // Interleave the bytes from every block into the final codeword sequence.
                    const result = [];
                    for (let i = 0; i < blocks[0].length; i++) {
                        blocks.forEach((block, j) => {
                            // Skip the padding placeholder column in short blocks' data area.
                            if (i !== shortBlockLen - blockEccLen || j >= numShortBlocks) {
                                result.push(block[i]);
                            }
                        });
                    }

                    // ---- Build module grid ----
                    const modules = Array.from({ length: size }, () => new Array(size).fill(false));
                    const isFunction = Array.from({ length: size }, () => new Array(size).fill(false));

                    function setFunctionModule(x, y, isDark) {
                        modules[y][x] = isDark;
                        isFunction[y][x] = true;
                    }
                    function drawFinder(x, y) {
                        for (let dy = -4; dy <= 4; dy++) {
                            for (let dx = -4; dx <= 4; dx++) {
                                const dist = Math.max(Math.abs(dx), Math.abs(dy));
                                const xx = x + dx;
                                const yy = y + dy;
                                if (xx >= 0 && xx < size && yy >= 0 && yy < size)
                                    setFunctionModule(xx, yy, dist !== 2 && dist !== 4);
                            }
                        }
                    }
                    function drawAlignment(x, y) {
                        for (let dy = -2; dy <= 2; dy++)
                            for (let dx = -2; dx <= 2; dx++)
                                setFunctionModule(x + dx, y + dy, Math.max(Math.abs(dx), Math.abs(dy)) !== 1);
                    }
                    function getAlignmentPatternPositions() {
                        if (version === 1) return [];
                        const numAlign = Math.floor(version / 7) + 2;
                        const step = version === 32 ? 26 : Math.ceil((version * 4 + 4) / (numAlign * 2 - 2)) * 2;
                        const result = [6];
                        for (let pos = size - 7; result.length < numAlign; pos -= step) result.splice(1, 0, pos);
                        return result;
                    }

                    // Timing patterns
                    for (let i = 0; i < size; i++) {
                        setFunctionModule(6, i, i % 2 === 0);
                        setFunctionModule(i, 6, i % 2 === 0);
                    }
                    // Finder patterns + separators
                    drawFinder(3, 3);
                    drawFinder(size - 4, 3);
                    drawFinder(3, size - 4);
                    // Alignment patterns
                    const alignPos = getAlignmentPatternPositions();
                    const numAlign = alignPos.length;
                    for (let i = 0; i < numAlign; i++) {
                        for (let j = 0; j < numAlign; j++) {
                            if (
                                !(
                                    (i === 0 && j === 0) ||
                                    (i === 0 && j === numAlign - 1) ||
                                    (i === numAlign - 1 && j === 0)
                                )
                            ) {
                                drawAlignment(alignPos[i], alignPos[j]);
                            }
                        }
                    }
                    // Reserve format + version info (filled later)
                    drawFormatBits(0); // dummy to reserve
                    drawVersion();

                    function drawFormatBits(mask) {
                        const eccBits = [1, 0, 3, 2][eccOrd]; // ordinal L,M,Q,H -> spec formatBits
                        const dataF = (eccBits << 3) | mask;
                        let rem = dataF;
                        for (let i = 0; i < 10; i++) rem = (rem << 1) ^ ((rem >>> 9) * 0x537);
                        const bits = ((dataF << 10) | rem) ^ 0x5412;
                        // first copy
                        for (let i = 0; i <= 5; i++) setFunctionModule(8, i, getBit(bits, i));
                        setFunctionModule(8, 7, getBit(bits, 6));
                        setFunctionModule(8, 8, getBit(bits, 7));
                        setFunctionModule(7, 8, getBit(bits, 8));
                        for (let i = 9; i < 15; i++) setFunctionModule(14 - i, 8, getBit(bits, i));
                        // second copy
                        for (let i = 0; i < 8; i++) setFunctionModule(size - 1 - i, 8, getBit(bits, i));
                        for (let i = 8; i < 15; i++) setFunctionModule(8, size - 15 + i, getBit(bits, i));
                        setFunctionModule(8, size - 8, true); // always-dark module
                    }
                    function drawVersion() {
                        if (version < 7) return;
                        let rem = version;
                        for (let i = 0; i < 12; i++) rem = (rem << 1) ^ ((rem >>> 11) * 0x1f25);
                        const bits = (version << 12) | rem;
                        for (let i = 0; i < 18; i++) {
                            const bit = getBit(bits, i);
                            const a = size - 11 + (i % 3);
                            const b = Math.floor(i / 3);
                            setFunctionModule(a, b, bit);
                            setFunctionModule(b, a, bit);
                        }
                    }
                    function getBit(x, i) {
                        return ((x >>> i) & 1) !== 0;
                    }

                    // ---- Place data + ECC codewords (zigzag) ----
                    let i = 0; // bit index into result
                    for (let right = size - 1; right >= 1; right -= 2) {
                        if (right === 6) right = 5; // skip vertical timing column
                        for (let vert = 0; vert < size; vert++) {
                            for (let j = 0; j < 2; j++) {
                                const x = right - j;
                                const upward = ((right + 1) & 2) === 0;
                                const y = upward ? size - 1 - vert : vert;
                                if (!isFunction[y][x] && i < result.length * 8) {
                                    modules[y][x] = getBit(result[i >>> 3], 7 - (i & 7));
                                    i++;
                                }
                            }
                        }
                    }

                    // ---- Masking: try all 8 masks, keep lowest penalty ----
                    function applyMask(mask) {
                        for (let y = 0; y < size; y++) {
                            for (let x = 0; x < size; x++) {
                                if (isFunction[y][x]) continue;
                                let invert;
                                switch (mask) {
                                    case 0: invert = (x + y) % 2 === 0; break;
                                    case 1: invert = y % 2 === 0; break;
                                    case 2: invert = x % 3 === 0; break;
                                    case 3: invert = (x + y) % 3 === 0; break;
                                    case 4: invert = (Math.floor(x / 3) + Math.floor(y / 2)) % 2 === 0; break;
                                    case 5: invert = ((x * y) % 2) + ((x * y) % 3) === 0; break;
                                    case 6: invert = (((x * y) % 2) + ((x * y) % 3)) % 2 === 0; break;
                                    case 7: invert = (((x + y) % 2) + ((x * y) % 3)) % 2 === 0; break;
                                }
                                if (invert) modules[y][x] = !modules[y][x];
                            }
                        }
                    }

                    // ISO/IEC 18004 mask-penalty score (the four standard rules).
                    const FINDER_A = [true, false, true, true, true, false, true, false, false, false, false];
                    const FINDER_B = [false, false, false, false, true, false, true, true, true, false, true];
                    function getPenalty() {
                        let result = 0;
                        // Rule 1: runs of >= 5 same-colour modules in each row and column.
                        for (let y = 0; y < size; y++) {
                            let run = 1, prev = modules[y][0];
                            for (let x = 1; x < size; x++) {
                                if (modules[y][x] === prev) run++;
                                else { if (run >= 5) result += 3 + (run - 5); run = 1; prev = modules[y][x]; }
                            }
                            if (run >= 5) result += 3 + (run - 5);
                        }
                        for (let x = 0; x < size; x++) {
                            let run = 1, prev = modules[0][x];
                            for (let y = 1; y < size; y++) {
                                if (modules[y][x] === prev) run++;
                                else { if (run >= 5) result += 3 + (run - 5); run = 1; prev = modules[y][x]; }
                            }
                            if (run >= 5) result += 3 + (run - 5);
                        }
                        // Rule 2: 2x2 blocks of the same colour.
                        for (let y = 0; y < size - 1; y++) {
                            for (let x = 0; x < size - 1; x++) {
                                const color = modules[y][x];
                                if (color === modules[y][x + 1] && color === modules[y + 1][x] && color === modules[y + 1][x + 1])
                                    result += 3;
                            }
                        }
                        // Rule 3: 1:1:3:1:1 finder-like patterns (with light border), both directions.
                        const scanLine = (get) => {
                            let count = 0;
                            for (let i = 0; i + 11 <= size; i++) {
                                let okA = true, okB = true;
                                for (let k = 0; k < 11; k++) {
                                    const v = get(i + k);
                                    if (v !== FINDER_A[k]) okA = false;
                                    if (v !== FINDER_B[k]) okB = false;
                                }
                                if (okA || okB) count += 40;
                            }
                            return count;
                        };
                        for (let y = 0; y < size; y++) result += scanLine((i) => modules[y][i]);
                        for (let x = 0; x < size; x++) result += scanLine((i) => modules[i][x]);
                        // Rule 4: deviation of dark-module proportion from 50%.
                        let dark = 0;
                        for (const row of modules) for (const v of row) if (v) dark++;
                        const ratio = (dark / (size * size)) * 100;
                        result += Math.floor(Math.abs(ratio - 50) / 5) * 10;
                        return result;
                    }

                    // Try every mask, pick the best (lowest penalty).
                    let bestMask = -1;
                    let minPenalty = Infinity;
                    for (let mask = 0; mask < 8; mask++) {
                        applyMask(mask);
                        drawFormatBits(mask);
                        const penalty = getPenalty();
                        if (penalty < minPenalty) {
                            bestMask = mask;
                            minPenalty = penalty;
                        }
                        applyMask(mask); // undo (XOR mask twice)
                    }
                    applyMask(bestMask);
                    drawFormatBits(bestMask);

                    return { size, modules };
                }

                return { encode };
            })();

            Alpine.data('blatQrCode', (value = '', ecc = 'M', margin = 4) => ({
                size: 0,
                modules: [],
                error: false,

                init() {
                    this.build();
                },

                build() {
                    try {
                        const text = value == null ? '' : String(value);
                        const out = QR.encode(text.length ? text : ' ', ['L', 'M', 'Q', 'H'].includes(ecc) ? ecc : 'M');
                        this.size = out.size;
                        this.modules = out.modules;
                        this.error = false;
                    } catch (e) {
                        this.error = true;
                        this.size = 0;
                        this.modules = [];
                    }
                },

                // Build a single <path> "d" string of all dark module rects (crisp, no AA seams).
                get pathData() {
                    let d = '';
                    const m = Number(margin) || 0;
                    for (let y = 0; y < this.modules.length; y++) {
                        for (let x = 0; x < this.modules[y].length; x++) {
                            if (this.modules[y][x]) {
                                d += 'M' + (x + m) + ',' + (y + m) + 'h1v1h-1z';
                            }
                        }
                    }
                    return d;
                },

                get viewBox() {
                    const total = this.size + 2 * (Number(margin) || 0);
                    return '0 0 ' + total + ' ' + total;
                },
            }));
        });
    </script>
@endonce

<div
    data-slot="qr-code"
    x-data="blatQrCode(@js((string) $value), @js($eccLevel), @js((int) $margin))"
    {{ $attributes->twMerge('text-foreground bg-background inline-block rounded-md') }}
    style="width: {{ (int) $size }}px; height: {{ (int) $size }}px;"
>
    <svg
        xmlns="http://www.w3.org/2000/svg"
        role="img"
        aria-label="{{ $label }}"
        :viewBox="viewBox"
        width="{{ (int) $size }}"
        height="{{ (int) $size }}"
        class="block h-full w-full"
        shape-rendering="crispEdges"
    >
        <path :d="pathData" fill="currentColor" x-show="!error"></path>
    </svg>
</div>

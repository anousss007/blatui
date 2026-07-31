// ---------------------------------------------------------------------------
// BlatUI Charts — OPT-IN engine for the <x-ui.chart> component.
//
// Charts are NOT part of the base BlatUI engine (blatui-core.js): ApexCharts is
// ~140kb and only ~10% of apps render charts, so we never force it on everyone.
// Install it only when you use charts:
//
//   php artisan blatui:add chart
//   npm install -D apexcharts
//
// Then register it alongside the core, before Alpine.start():
//
//   import { registerBlatUI } from './blatui-core.js';
//   import { registerCharts } from './blatui-charts.js';
//   registerBlatUI(Alpine);
//   registerCharts(Alpine);
//   Alpine.start();
// ---------------------------------------------------------------------------

// ApexCharts is ~140kb gzipped — load it on demand (only on pages with charts)
// instead of shipping it in the main bundle. Returns the constructor.
let _apexPromise = null;
function loadApex() {
    if (window.ApexCharts) return Promise.resolve(window.ApexCharts);
    if (!_apexPromise) {
        _apexPromise = import('apexcharts').then((m) => {
            window.ApexCharts = m.default || m;
            return window.ApexCharts;
        });
    }
    return _apexPromise;
}

const _colorProbe = document.createElement('span');
_colorProbe.style.cssText = 'position:absolute;width:0;height:0;opacity:0;pointer-events:none;';
const _colorCanvas = document.createElement('canvas').getContext('2d');

// OKLCH → sRGB. shadcn v4 declares every token in oklch, and neither
// getComputedStyle nor canvas reliably down-converts it, so we do it by hand.
function oklchToRgb(str) {
    const m = str.match(/oklch\(\s*([\d.]+%?)\s+([\d.]+%?)\s+([\d.]+)(?:deg)?\s*(?:\/\s*([\d.]+%?))?\s*\)/i);
    if (!m) return null;
    const L = m[1].endsWith('%') ? parseFloat(m[1]) / 100 : parseFloat(m[1]);
    const C = m[2].endsWith('%') ? (parseFloat(m[2]) / 100) * 0.4 : parseFloat(m[2]);
    const H = parseFloat(m[3]);
    const hr = (H * Math.PI) / 180;
    const a = C * Math.cos(hr);
    const b = C * Math.sin(hr);
    const l_ = L + 0.3963377774 * a + 0.2158037573 * b;
    const m_ = L - 0.1055613458 * a - 0.0638541728 * b;
    const s_ = L - 0.0894841775 * a - 1.291485548 * b;
    const l3 = l_ ** 3, m3 = m_ ** 3, s3 = s_ ** 3;
    const lr = 4.0767416621 * l3 - 3.3077115913 * m3 + 0.2309699292 * s3;
    const lg = -1.2684380046 * l3 + 2.6097574011 * m3 - 0.3413193965 * s3;
    const lb = -0.0041960863 * l3 - 0.7034186147 * m3 + 1.707614701 * s3;
    const g = (x) => (x <= 0.0031308 ? 12.92 * x : 1.055 * Math.pow(x, 1 / 2.4) - 0.055);
    const u = (x) => Math.round(Math.min(1, Math.max(0, g(x))) * 255);
    const A = m[4] != null ? (m[4].endsWith('%') ? parseFloat(m[4]) / 100 : parseFloat(m[4])) : 1;
    const [R, G, B] = [u(lr), u(lg), u(lb)];
    return A < 1 ? `rgba(${R}, ${G}, ${B}, ${A})` : `rgb(${R}, ${G}, ${B})`;
}

// Canvas normalises hsl / named / lab / #hex to rgb.
function toRenderColor(value) {
    if (/^oklch/i.test(value)) return oklchToRgb(value) || value;
    try {
        _colorCanvas.fillStyle = '#000000';
        _colorCanvas.fillStyle = value;
        return _colorCanvas.fillStyle;
    } catch (e) {
        return value;
    }
}

function resolveColor(value) {
    if (Array.isArray(value)) return value.map(resolveColor);
    if (typeof value !== 'string') return value;
    if (!/var\(|oklch|oklab|hsl|color-mix|lab\(|lch\(|^#|^rgb/.test(value)) return value;
    let v = value;
    // Step 1: resolve CSS custom properties (var(--x)) to their computed value.
    if (v.includes('var(')) {
        if (!_colorProbe.isConnected) document.body.appendChild(_colorProbe);
        _colorProbe.style.color = '';
        _colorProbe.style.color = v;
        v = getComputedStyle(_colorProbe).color || v;
    }
    // Step 2: normalise whatever color space we got to rgb for ApexCharts.
    return toRenderColor(v);
}

function themeColor(name, fallback = '') {
    const v = resolveColor(`var(${name})`);
    return v || fallback;
}

function isDark() {
    return document.documentElement.classList.contains('dark');
}

function isPlainObject(v) {
    return v && typeof v === 'object' && !Array.isArray(v);
}

function deepMerge(target, source) {
    const out = { ...target };
    for (const key in source) {
        if (isPlainObject(source[key]) && isPlainObject(out[key])) {
            out[key] = deepMerge(out[key], source[key]);
        } else {
            out[key] = source[key];
        }
    }
    return out;
}

// Recursively resolve any color-looking string leaves inside an options object.
function resolveColorsDeep(obj) {
    if (Array.isArray(obj)) return obj.map(resolveColorsDeep);
    if (isPlainObject(obj)) {
        const out = {};
        for (const k in obj) out[k] = resolveColorsDeep(obj[k]);
        return out;
    }
    if (typeof obj === 'string' && /var\(|oklch/.test(obj)) return resolveColor(obj);
    return obj;
}

function chartBaseOptions() {
    const muted = themeColor('--muted-foreground');
    const border = themeColor('--border');
    const card = themeColor('--popover');
    return {
        chart: {
            fontFamily: 'inherit',
            background: 'transparent',
            toolbar: { show: false },
            zoom: { enabled: false },
            parentHeightOffset: 0,
            animations: { enabled: true, speed: 350 },
            redrawOnParentResize: true,
        },
        grid: {
            borderColor: border,
            strokeDashArray: 4,
            xaxis: { lines: { show: false } },
            padding: { left: 8, right: 8, top: 0, bottom: 0 },
        },
        dataLabels: { enabled: false },
        stroke: { curve: 'smooth', width: 2, lineCap: 'round' },
        legend: {
            fontSize: '12px',
            labels: { colors: muted },
            markers: { width: 8, height: 8, radius: 2 },
            itemMargin: { horizontal: 8, vertical: 4 },
        },
        tooltip: {
            theme: isDark() ? 'dark' : 'light',
            style: { fontSize: '12px', fontFamily: 'inherit' },
        },
        xaxis: {
            labels: { style: { colors: muted, fontSize: '12px', fontFamily: 'inherit' } },
            axisBorder: { show: false },
            axisTicks: { show: false },
            crosshairs: { stroke: { color: border, dashArray: 0 } },
        },
        yaxis: {
            labels: { style: { colors: muted, fontSize: '12px', fontFamily: 'inherit' } },
        },
        states: { hover: { filter: { type: 'lighten', value: 0.05 } } },
        plotOptions: { bar: { borderRadius: 6, borderRadiusApplication: 'end' } },
    };
}

function buildChartOptions(raw) {
    const base = chartBaseOptions();
    const top = {
        chart: { type: raw.type || 'line', height: raw.height || 250 },
        series: raw.series || [],
        colors: resolveColor(raw.colors || []),
    };
    if (Array.isArray(raw.labels)) top.labels = raw.labels;
    const merged = deepMerge(base, top);
    return deepMerge(merged, resolveColorsDeep(raw.options || {}));
}

// Composable helpers on window.Chart for bespoke blocks (e.g. the interactive
// dashboard chart) that drive ApexCharts directly.
window.Chart = { resolveColor, themeColor, isDark, deepMerge, buildChartOptions, load: loadApex };

function observeTheme(callback) {
    let timer = null;
    const obs = new MutationObserver(() => {
        clearTimeout(timer);
        timer = setTimeout(callback, 60);
    });
    obs.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['class', 'data-theme', 'data-base'],
    });
    return obs;
}
window.Chart.observeTheme = observeTheme;

// Alpine component backing <x-ui.chart>. Mirrors shadcn's <ChartContainer>:
// resolves CSS-variable / oklch colors to rgb, and re-themes on dark-mode /
// preset / base-color changes.
const shadcnChart = (raw = {}) => ({
    _chart: null,
    _raw: raw,
    _obs: null,
    _ready: false,
    init() {
        this.$nextTick(async () => {
            if (!this.$refs.canvas) return;
            const ApexCharts = await loadApex();
            this._chart = new ApexCharts(this.$refs.canvas, buildChartOptions(this._raw));
            await this._chart.render();
            this._ready = true;
            // Re-theme only AFTER the first render is committed.
            this._obs = observeTheme(() => this._rerender());
        });
    },
    _rerender() {
        if (this._chart && this._ready) {
            try {
                this._chart.updateOptions(buildChartOptions(this._raw), false, false);
            } catch (e) { /* ignore transient theme races */ }
        }
    },
    setSeries(series) {
        this._raw.series = series;
        if (this._chart && this._ready) this._chart.updateSeries(series, true);
    },
    setRaw(patch) {
        this._raw = deepMerge(this._raw, patch);
        this._rerender();
    },
    destroy() {
        if (this._chart) this._chart.destroy();
        if (this._obs) this._obs.disconnect();
    },
});

// Register the chart component into an Alpine instance. Call BEFORE Alpine.start().
export function registerCharts(Alpine) {
    Alpine.data('shadcnChart', shadcnChart);
}

<?php

namespace BlatUI;

/**
 * A minimal, dependency-free line differ — enough to show a consumer exactly
 * what `blatui:update` is about to overwrite in a component they own.
 *
 * Not a general-purpose diff library: it handles the sizes component stubs come
 * in (hundreds of lines) and degrades to a whole-file replace when a pathological
 * pair would blow up the LCS table.
 */
class Diff
{
    /** Largest LCS table (cells) we are willing to build before degrading. */
    protected const MAX_CELLS = 4_000_000;

    /**
     * Line-by-line edit script: [' '|'-'|'+', line] pairs, in output order.
     *
     * @param  list<string>  $a
     * @param  list<string>  $b
     * @return list<array{0: string, 1: string}>
     */
    public static function ops(array $a, array $b): array
    {
        $n = count($a);
        $m = count($b);

        // Common prefix/suffix never needs the LCS table — trimming them keeps
        // the usual "one line changed in a 600-line component" case cheap.
        $head = 0;
        while ($head < $n && $head < $m && $a[$head] === $b[$head]) {
            $head++;
        }
        $tailA = $n - 1;
        $tailB = $m - 1;
        while ($tailA >= $head && $tailB >= $head && $a[$tailA] === $b[$tailB]) {
            $tailA--;
            $tailB--;
        }

        $ops = [];
        for ($i = 0; $i < $head; $i++) {
            $ops[] = [' ', $a[$i]];
        }

        $midA = array_slice($a, $head, $tailA - $head + 1);
        $midB = array_slice($b, $head, $tailB - $head + 1);
        foreach (self::middle($midA, $midB) as $op) {
            $ops[] = $op;
        }

        for ($i = $tailA + 1; $i < $n; $i++) {
            $ops[] = [' ', $a[$i]];
        }

        return $ops;
    }

    /** Unified diff, or '' when the two sides are identical. */
    public static function unified(string $old, string $new, string $labelOld = 'installed', string $labelNew = 'registry', int $context = 3): string
    {
        if ($old === $new) {
            return '';
        }

        $ops = self::ops(self::split($old), self::split($new));

        // Mark which ops are changes, then keep every op within `context` of one.
        $keep = [];
        foreach ($ops as $i => [$type]) {
            if ($type === ' ') {
                continue;
            }
            for ($j = max(0, $i - $context); $j <= min(count($ops) - 1, $i + $context); $j++) {
                $keep[$j] = true;
            }
        }

        $out = ["--- {$labelOld}", "+++ {$labelNew}"];
        $oldNo = 1;
        $newNo = 1;
        $hunk = [];
        $hunkOldStart = 1;
        $hunkNewStart = 1;
        $hunkOldLen = 0;
        $hunkNewLen = 0;

        $flush = function () use (&$out, &$hunk, &$hunkOldStart, &$hunkNewStart, &$hunkOldLen, &$hunkNewLen) {
            if (! $hunk) {
                return;
            }
            $out[] = "@@ -{$hunkOldStart},{$hunkOldLen} +{$hunkNewStart},{$hunkNewLen} @@";
            foreach ($hunk as $line) {
                $out[] = $line;
            }
            $hunk = [];
            $hunkOldLen = 0;
            $hunkNewLen = 0;
        };

        foreach ($ops as $i => [$type, $line]) {
            if (isset($keep[$i])) {
                if (! $hunk) {
                    $hunkOldStart = $oldNo;
                    $hunkNewStart = $newNo;
                }
                $hunk[] = $type.$line;
                if ($type !== '+') {
                    $hunkOldLen++;
                }
                if ($type !== '-') {
                    $hunkNewLen++;
                }
            } else {
                $flush();
            }

            if ($type !== '+') {
                $oldNo++;
            }
            if ($type !== '-') {
                $newNo++;
            }
        }
        $flush();

        return implode("\n", $out);
    }

    /**
     * Added/removed line counts — the one-line summary shown per file.
     *
     * @return array{added: int, removed: int}
     */
    public static function stat(string $old, string $new): array
    {
        $added = 0;
        $removed = 0;
        foreach (self::ops(self::split($old), self::split($new)) as [$type]) {
            if ($type === '+') {
                $added++;
            } elseif ($type === '-') {
                $removed++;
            }
        }

        return ['added' => $added, 'removed' => $removed];
    }

    /**
     * True when two files carry the same content and differ only in how it is laid out.
     *
     * Projects that run Pint/Prettier over `resources/views` reformat the components they
     * copied — a multi-line attribute collapsed onto one line reads as a changed file to a
     * byte comparison, and drowns the handful that genuinely drifted.
     *
     * Whitespace is dropped entirely rather than collapsed to a single space: a formatter
     * that joins `@keydown="\n    expr\n"` into `@keydown="expr"` removes the spacing, it does
     * not normalise it, so collapsing would still report a difference. The cost is that a
     * change consisting *only* of a space inside text or a class list reads as equal — which
     * is why this is opt-in behaviour rather than the default comparison.
     *
     * It does NOT forgive every reformatting either: reordered Tailwind classes, flipped
     * quotes and added trailing commas change the bytes between the whitespace, and are
     * indistinguishable from an edit that matters.
     */
    public static function sameIgnoringWhitespace(string $a, string $b): bool
    {
        return self::stripWhitespace($a) === self::stripWhitespace($b);
    }

    protected static function stripWhitespace(string $text): string
    {
        return (string) preg_replace('/\s+/', '', $text);
    }

    /** @return list<string> */
    protected static function split(string $text): array
    {
        return preg_split("/\r\n|\n|\r/", $text) ?: [];
    }

    /**
     * @param  list<string>  $a
     * @param  list<string>  $b
     * @return list<array{0: string, 1: string}>
     */
    protected static function middle(array $a, array $b): array
    {
        $n = count($a);
        $m = count($b);

        if ($n === 0 || $m === 0 || $n * $m > self::MAX_CELLS) {
            return array_merge(
                array_map(fn (string $l) => ['-', $l], $a),
                array_map(fn (string $l) => ['+', $l], $b),
            );
        }

        // Classic LCS length table, backtracked into an edit script.
        $lcs = array_fill(0, $n + 1, array_fill(0, $m + 1, 0));
        for ($i = $n - 1; $i >= 0; $i--) {
            for ($j = $m - 1; $j >= 0; $j--) {
                $lcs[$i][$j] = $a[$i] === $b[$j]
                    ? $lcs[$i + 1][$j + 1] + 1
                    : max($lcs[$i + 1][$j], $lcs[$i][$j + 1]);
            }
        }

        $ops = [];
        $i = 0;
        $j = 0;
        while ($i < $n && $j < $m) {
            if ($a[$i] === $b[$j]) {
                $ops[] = [' ', $a[$i]];
                $i++;
                $j++;
            } elseif ($lcs[$i + 1][$j] >= $lcs[$i][$j + 1]) {
                $ops[] = ['-', $a[$i]];
                $i++;
            } else {
                $ops[] = ['+', $b[$j]];
                $j++;
            }
        }
        while ($i < $n) {
            $ops[] = ['-', $a[$i++]];
        }
        while ($j < $m) {
            $ops[] = ['+', $b[$j++]];
        }

        return $ops;
    }
}

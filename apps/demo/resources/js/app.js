import Alpine from 'alpinejs';
import anchor from '@alpinejs/anchor';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse';

Alpine.plugin(anchor);
Alpine.plugin(focus);
Alpine.plugin(collapse);

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

// ---------------------------------------------------------------------------
// Theme store — dark mode + color preset + radius, persisted to localStorage.
// Mirrors the data-attributes that resources/css/app.css keys off of.
// ---------------------------------------------------------------------------
Alpine.store('theme', {
    // Every dimension shadcn exposes, each persisted independently.
    mode: localStorage.getItem('theme:mode') || 'system',
    base: localStorage.getItem('theme:base') || 'neutral',
    preset: localStorage.getItem('theme:preset') || 'default',
    radius: localStorage.getItem('theme:radius') || '0.625',
    font: localStorage.getItem('theme:font') || 'sans',
    shadow: localStorage.getItem('theme:shadow') || 'default',
    spacing: localStorage.getItem('theme:spacing') || 'default',
    tracking: localStorage.getItem('theme:tracking') || 'normal',

    init() {
        this.apply();
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if (this.mode === 'system') this.apply();
        });
        // Keep every same-origin document in sync (e.g. block-preview iframes):
        // localStorage writes in one document fire a `storage` event in the others.
        const defaults = { mode: 'system', base: 'neutral', preset: 'default', radius: '0.625', font: 'sans', shadow: 'default', spacing: 'default', tracking: 'normal' };
        window.addEventListener('storage', (e) => {
            if (!e.key || !e.key.startsWith('theme:')) return;
            const key = e.key.slice('theme:'.length);
            if (key in defaults) {
                this[key] = e.newValue ?? defaults[key];
                this.apply();
            }
        });
    },

    get isDark() {
        return this.mode === 'dark' || (this.mode === 'system' && window.matchMedia('(prefers-color-scheme: dark)').matches);
    },

    set(key, value) {
        this[key] = value;
        localStorage.setItem('theme:' + key, value);
        this.apply();
    },

    setMode(mode) { this.set('mode', mode); },
    setBase(base) { this.set('base', base); },
    setPreset(preset) { this.set('preset', preset); },
    setRadius(radius) { this.set('radius', radius); },
    setFont(font) { this.set('font', font); },
    setShadow(shadow) { this.set('shadow', shadow); },
    setSpacing(spacing) { this.set('spacing', spacing); },
    setTracking(tracking) { this.set('tracking', tracking); },

    toggle() {
        this.setMode(this.isDark ? 'light' : 'dark');
    },

    reset() {
        ['mode', 'base', 'preset', 'radius', 'font', 'shadow', 'spacing', 'tracking'].forEach((k) =>
            localStorage.removeItem('theme:' + k),
        );
        this.mode = 'system';
        this.base = 'neutral';
        this.preset = 'default';
        this.radius = '0.625';
        this.font = 'sans';
        this.shadow = 'default';
        this.spacing = 'default';
        this.tracking = 'normal';
        this.apply();
    },

    apply() {
        const root = document.documentElement;
        root.classList.toggle('dark', this.isDark);
        // Attributes only emitted when non-default, so :root keeps the defaults.
        this.attr(root, 'data-base', this.base, 'neutral');
        this.attr(root, 'data-theme', this.preset, 'default');
        this.attr(root, 'data-font', this.font, 'sans');
        this.attr(root, 'data-shadow', this.shadow, 'default');
        this.attr(root, 'data-spacing', this.spacing, 'default');
        this.attr(root, 'data-tracking', this.tracking, 'normal');
        root.setAttribute('data-radius', this.radius);
    },

    attr(root, name, value, fallback) {
        if (value && value !== fallback) root.setAttribute(name, value);
        else root.removeAttribute(name);
    },
});

// ---------------------------------------------------------------------------
// Toast helper — dispatches an event the <x-ui.sonner /> Toaster listens for.
//   toast('Saved')                       → simple message
//   toast({ title, description, type })  → full control (type: default|success|error|warning|info)
// ---------------------------------------------------------------------------
window.toast = (opts) => {
    const detail = typeof opts === 'string' ? { title: opts } : (opts || {});
    window.dispatchEvent(new CustomEvent('toast', { detail }));
};
['success', 'error', 'warning', 'info'].forEach((type) => {
    window.toast[type] = (opts) => {
        const detail = typeof opts === 'string' ? { title: opts } : (opts || {});
        window.dispatchEvent(new CustomEvent('toast', { detail: { ...detail, type } }));
    };
});

// ---------------------------------------------------------------------------
// Charts — ApexCharts wrapper that mirrors shadcn's <ChartContainer>.
//   * Resolves CSS-variable / oklch colors to concrete rgb() so ApexCharts'
//     gradient + shade utilities work.
//   * Re-renders on dark-mode / theme-preset / base-color changes.
//   * Exposed as the Alpine component `shadcnChart` and composable helpers on
//     window.Chart for bespoke blocks (e.g. the interactive dashboard chart).
// ---------------------------------------------------------------------------
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

Alpine.data('shadcnChart', (raw = {}) => ({
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
}));

// ---------------------------------------------------------------------------
// Calendar — Alpine day-picker mirroring shadcn/react-day-picker's <Calendar>.
//   Supports: mode single|multiple|range, numberOfMonths, captionLayout
//   label|dropdown, showWeekNumber, disabled matchers (array | {before,after,
//   dayOfWeek}), min/max, required, startMonth/endMonth, disableNavigation,
//   modifiers + modifier classNames, weekStart.
// ---------------------------------------------------------------------------
function _ymd(d) {
    return d.getFullYear() + '-' + String(d.getMonth() + 1).padStart(2, '0') + '-' + String(d.getDate()).padStart(2, '0');
}
function _parse(s) {
    if (!s) return null;
    if (s instanceof Date) return new Date(s.getFullYear(), s.getMonth(), s.getDate());
    const p = String(s).split('-').map(Number);
    return new Date(p[0], (p[1] || 1) - 1, p[2] || 1);
}
function _sameDay(a, b) { return a && b && _ymd(a) === _ymd(b); }
function _addMonths(d, n) { return new Date(d.getFullYear(), d.getMonth() + n, 1); }

Alpine.data('calendar', (cfg = {}) => ({
    mode: cfg.mode || 'single',
    locale: cfg.locale || 'en-US',
    numberOfMonths: cfg.numberOfMonths || 1,
    weekStart: cfg.weekStart || 0,
    captionLayout: cfg.captionLayout || 'label',
    showWeekNumber: !!cfg.showWeekNumber,
    disableNavigation: !!cfg.disableNavigation,
    minDays: cfg.min || null,
    maxDays: cfg.max || null,
    disabledCfg: cfg.disabled || null,
    modifiers: cfg.modifiers || {},
    modifiersClass: cfg.modifiersClass || {},
    startMonth: null,
    endMonth: null,
    view: null,
    weekdays: [],
    // selection state
    single: null,
    multiple: [],
    rangeFrom: null,
    rangeTo: null,
    hover: null,

    init() {
        this.startMonth = cfg.startMonth ? _parse(cfg.startMonth) : null;
        this.endMonth = cfg.endMonth ? _parse(cfg.endMonth) : null;
        // seed selection
        if (this.mode === 'single') this.single = cfg.value ? _parse(cfg.value) : null;
        else if (this.mode === 'multiple') this.multiple = (cfg.value || []).map(_parse);
        else if (this.mode === 'range') {
            this.rangeFrom = cfg.value && cfg.value.from ? _parse(cfg.value.from) : null;
            this.rangeTo = cfg.value && cfg.value.to ? _parse(cfg.value.to) : null;
        }
        // default month
        let base = null;
        if (cfg.defaultMonth) base = _parse(cfg.defaultMonth.length === 7 ? cfg.defaultMonth + '-01' : cfg.defaultMonth);
        else base = this.single || this.rangeFrom || (this.multiple && this.multiple[0]) || this.startMonth || new Date();
        this.view = new Date(base.getFullYear(), base.getMonth(), 1);
        // weekday headers
        const ref = new Date(2023, 0, 1);
        for (let i = 0; i < 7; i++) {
            const d = new Date(ref);
            d.setDate(ref.getDate() + ((this.weekStart + i + 7 - ref.getDay()) % 7));
            this.weekdays.push(d.toLocaleString(this.locale, { weekday: 'narrow' }));
        }
        // External "Today" hook (used by calendar-10 etc.)
        window.addEventListener('calendar:today', () => {
            const t = new Date();
            this.view = new Date(t.getFullYear(), t.getMonth(), 1);
            if (this.mode === 'single') { this.single = t; this.emit(_ymd(t)); }
        });
        // External "set date" hook (used by preset blocks, e.g. calendar-19).
        // Detail may be a 'YYYY-MM-DD' string or a Date; single mode only.
        window.addEventListener('calendar:set', (e) => {
            const t = _parse(e.detail);
            if (!t) return;
            this.view = new Date(t.getFullYear(), t.getMonth(), 1);
            if (this.mode === 'single') { this.single = t; this.emit(_ymd(t)); }
        });
    },

    // ---- grid building ----
    get months() {
        return Array.from({ length: this.numberOfMonths }, (_, i) => _addMonths(this.view, i));
    },
    monthLabel(m) { return m.toLocaleString(this.locale, { month: 'long', year: 'numeric' }); },
    weeksFor(m) {
        const year = m.getFullYear(), month = m.getMonth();
        const first = new Date(year, month, 1);
        const offset = (first.getDay() - this.weekStart + 7) % 7;
        const start = new Date(year, month, 1 - offset);
        const weeks = [];
        for (let w = 0; w < 6; w++) {
            const days = [];
            for (let d = 0; d < 7; d++) {
                const day = new Date(start);
                day.setDate(start.getDate() + w * 7 + d);
                days.push(day);
            }
            weeks.push(days);
        }
        return weeks;
    },
    weekNumber(week) {
        const d = new Date(week[0]);
        d.setDate(d.getDate() + 3 - ((d.getDay() + 6) % 7));
        const firstThu = new Date(d.getFullYear(), 0, 4);
        return 1 + Math.round(((d - firstThu) / 86400000 - 3 + ((firstThu.getDay() + 6) % 7)) / 7);
    },

    // ---- predicates ----
    isOutside(d, m) { return d.getMonth() !== m.getMonth(); },
    isToday(d) { return _sameDay(d, new Date()); },
    isDisabled(d) {
        if (this.startMonth && d < new Date(this.startMonth.getFullYear(), this.startMonth.getMonth(), 1)) return true;
        if (this.endMonth && d > new Date(this.endMonth.getFullYear(), this.endMonth.getMonth() + 1, 0)) return true;
        const c = this.disabledCfg;
        if (!c) return false;
        if (Array.isArray(c)) return c.some((x) => _sameDay(_parse(x), d));
        if (typeof c === 'object') {
            if (c.before && d < _parse(c.before)) return true;
            if (c.after && d > _parse(c.after)) return true;
            if (c.dayOfWeek && c.dayOfWeek.includes(d.getDay())) return true;
        }
        return false;
    },
    isSelected(d) {
        if (this.mode === 'single') return _sameDay(this.single, d);
        if (this.mode === 'multiple') return this.multiple.some((x) => _sameDay(x, d));
        return this.rangeIs(d).selected;
    },
    rangeIs(d) {
        const from = this.rangeFrom, to = this.rangeTo || (this.rangeFrom && this.hover);
        if (!from) return {};
        const lo = to && to < from ? to : from;
        const hi = to && to < from ? from : to;
        const isStart = _sameDay(d, lo);
        const isEnd = hi ? _sameDay(d, hi) : isStart;
        const inMid = hi && d > lo && d < hi;
        return { selected: isStart || isEnd || inMid, start: isStart, end: isEnd, middle: inMid };
    },
    modifierClass(d) {
        let cls = '';
        for (const name in this.modifiers) {
            const list = this.modifiers[name] || [];
            if (list.some((x) => _sameDay(_parse(x), d))) cls += ' ' + (this.modifiersClass[name] || '');
        }
        return cls;
    },

    // ---- interaction ----
    select(d) {
        if (this.isDisabled(d)) return;
        if (this.mode === 'single') {
            this.single = _sameDay(this.single, d) && !cfg.required ? null : d;
            this.emit(this.single ? _ymd(this.single) : null);
        } else if (this.mode === 'multiple') {
            const i = this.multiple.findIndex((x) => _sameDay(x, d));
            if (i >= 0) this.multiple.splice(i, 1);
            else if (!this.maxDays || this.multiple.length < this.maxDays) this.multiple.push(d);
            this.emit(this.multiple.map(_ymd));
        } else {
            if (!this.rangeFrom || (this.rangeFrom && this.rangeTo)) {
                this.rangeFrom = d; this.rangeTo = null;
            } else {
                let from = this.rangeFrom, to = d;
                if (to < from) [from, to] = [to, from];
                const span = Math.round((to - from) / 86400000) + 1;
                if (this.minDays && span < this.minDays) { this.rangeFrom = d; this.rangeTo = null; }
                else if (this.maxDays && span > this.maxDays) { this.rangeFrom = d; this.rangeTo = null; }
                else { this.rangeFrom = from; this.rangeTo = to; }
            }
            this.emit({ from: this.rangeFrom ? _ymd(this.rangeFrom) : null, to: this.rangeTo ? _ymd(this.rangeTo) : null });
        }
    },
    emit(value) { this.$dispatch('calendar-change', value); },

    // ---- navigation ----
    get canPrev() {
        if (this.disableNavigation) return false;
        if (!this.startMonth) return true;
        return _addMonths(this.view, -1) >= new Date(this.startMonth.getFullYear(), this.startMonth.getMonth(), 1);
    },
    get canNext() {
        if (this.disableNavigation) return false;
        if (!this.endMonth) return true;
        return _addMonths(this.view, this.numberOfMonths) <= new Date(this.endMonth.getFullYear(), this.endMonth.getMonth(), 1);
    },
    prev() { if (this.canPrev) this.view = _addMonths(this.view, -1); },
    next() { if (this.canNext) this.view = _addMonths(this.view, 1); },

    // ---- dropdown caption ----
    get years() {
        const start = this.startMonth ? this.startMonth.getFullYear() : new Date().getFullYear() - 100;
        const end = this.endMonth ? this.endMonth.getFullYear() : new Date().getFullYear() + 10;
        return Array.from({ length: end - start + 1 }, (_, i) => start + i);
    },
    get monthNames() {
        return Array.from({ length: 12 }, (_, i) => new Date(2023, i, 1).toLocaleString(this.locale, { month: 'long' }));
    },
    setMonth(m) { this.view = new Date(this.view.getFullYear(), Number(m), 1); },
    setYear(y) { this.view = new Date(Number(y), this.view.getMonth(), 1); },

    // ---- form value helpers ----
    fmt(d) { return d ? _ymd(d) : ''; },
    get multipleValue() { return this.multiple.map(_ymd).join(','); },
}));

// ---------------------------------------------------------------------------
// Theme export — resolve the CURRENT customization (base color, accent, radius)
// into concrete CSS variables the user can paste into their own app.css.
// Reads computed :root values in both light and dark and emits two blocks.
// ---------------------------------------------------------------------------
const THEME_TOKENS = [
    '--radius',
    '--background', '--foreground',
    '--card', '--card-foreground',
    '--popover', '--popover-foreground',
    '--primary', '--primary-foreground',
    '--secondary', '--secondary-foreground',
    '--muted', '--muted-foreground',
    '--accent', '--accent-foreground',
    '--destructive', '--destructive-foreground',
    '--border', '--input', '--ring',
    '--chart-1', '--chart-2', '--chart-3', '--chart-4', '--chart-5',
    '--sidebar', '--sidebar-foreground', '--sidebar-primary', '--sidebar-primary-foreground',
    '--sidebar-accent', '--sidebar-accent-foreground', '--sidebar-border', '--sidebar-ring',
];

function _readTokens() {
    const cs = getComputedStyle(document.documentElement);
    const out = {};
    THEME_TOKENS.forEach((t) => {
        const v = cs.getPropertyValue(t).trim();
        if (v) out[t] = v;
    });
    return out;
}

window.exportTheme = function () {
    const root = document.documentElement;
    const wasDark = root.classList.contains('dark');
    root.classList.remove('dark');
    const light = _readTokens();
    root.classList.add('dark');
    const dark = _readTokens();
    root.classList.toggle('dark', wasDark);
    const fmt = (o) => THEME_TOKENS.filter((t) => o[t]).map((t) => `  ${t}: ${o[t]};`).join('\n');
    return `:root {\n${fmt(light)}\n}\n\n.dark {\n${fmt(dark)}\n}`;
};

window.Alpine = Alpine;
Alpine.start();

<?php

// Drives the docs sidebar + index grouping. Keys are category labels,
// values are ordered component slugs (must match resources/views/components/ui).
return [
    'categories' => [
        'Forms & Input' => [
            'button', 'button-group', 'copy-button', 'input', 'input-group', 'input-mask', 'input-otp', 'number-input', 'phone-input', 'textarea', 'autosize-textarea',
            'label', 'field', 'checkbox', 'radio-group', 'switch', 'select', 'combobox', 'autocomplete', 'tags-input',
            'slider', 'toggle', 'toggle-group', 'rating', 'color-picker', 'password-strength', 'file-upload', 'editable', 'calendar', 'date-picker',
            'datetime-picker', 'time-field',
        ],
        'Layout' => [
            'card', 'aspect-ratio', 'separator', 'scroll-area', 'resizable', 'sidebar', 'accent',
        ],
        'Data Display' => [
            'avatar', 'badge', 'table', 'comparison-table', 'data-table', 'description-list', 'carousel', 'gallery', 'video', 'chart', 'sparkline', 'stat', 'icon', 'item',
            'kbd', 'marquee', 'typewriter', 'text-reveal', 'quote', 'progress', 'countdown', 'timeline', 'tree', 'json-viewer', 'skeleton', 'code-block', 'typography',
        ],
        'AI' => [
            'chat', 'prompt-input', 'streaming-text', 'reasoning', 'tool-call', 'citation', 'terminal',
        ],
        'Feedback' => [
            'alert', 'banner', 'empty', 'spinner', 'sonner', 'tooltip', 'hover-card',
        ],
        'Overlays' => [
            'dialog', 'alert-dialog', 'sheet', 'drawer', 'popover', 'dropdown-menu',
            'context-menu', 'menubar', 'command', 'command-dialog',
        ],
        'Navigation' => [
            'breadcrumb', 'link', 'tabs', 'navigation-menu', 'pagination', 'stepper',
        ],
        'Disclosure' => [
            'accordion', 'collapsible',
        ],
    ],

    // Display-name overrides for slugs whose humanized form is wrong (acronyms, etc.).
    'labels' => [
        'input-otp' => 'Input OTP',
        'datetime-picker' => 'Date & Time Picker',
        'json-viewer' => 'JSON Viewer',
    ],

    // Optional one-line descriptions shown on each component page.
    'descriptions' => [
        'button' => 'Displays a button or a component that looks like a button.',
        'button-group' => 'Groups related buttons together with consistent styling.',
        'copy-button' => 'A button that copies text to the clipboard, with a copied state and a live announcement.',
        'input' => 'Displays a form input field or a component that looks like an input field.',
        'input-group' => 'Group inputs with text, buttons, icons, and more.',
        'input-mask' => 'A text input that formats its value against a mask as you type.',
        'phone-input' => 'A phone number field with a searchable country-code selector.',
        'input-otp' => 'Accessible one-time password component with copy-paste functionality.',
        'textarea' => 'Displays a form textarea or a component that looks like a textarea.',
        'label' => 'Renders an accessible label associated with controls.',
        'field' => 'Combine labels, controls, and help text to compose accessible form fields.',
        'checkbox' => 'A control that allows the user to toggle between checked and not checked.',
        'radio-group' => 'A set of checkable buttons where no more than one can be checked at a time.',
        'switch' => 'A control that allows the user to toggle between an on and off state.',
        'select' => 'Displays a list of options for the user to pick from, triggered by a button.',
        'combobox' => 'Autocomplete input and command palette with a list of suggestions.',
        'autocomplete' => 'A text input that filters and suggests options as you type.',
        'slider' => 'An input where the user selects a value — single, or a two-handle min–max range.',
        'toggle' => 'A two-state button that can be either on or off.',
        'toggle-group' => 'A set of two-state buttons that can be toggled on or off.',
        'rating' => 'A star rating input with hover preview, keyboard support and a hidden field for forms.',
        'calendar' => 'A date field component that allows users to enter and edit dates.',
        'date-picker' => 'A date picker component with a calendar popover.',
        'datetime-picker' => 'Pick a date and a time together — single or range — in one popover.',
        'time-field' => 'A time input with native and dropdown variants, 12/24-hour and seconds.',
        'number-input' => 'A numeric stepper with minus/plus buttons that clamp a value to an optional min, max and step.',
        'tags-input' => 'A tag entry field — type and press Enter or comma to add removable chips, with form-array submission.',
        'autosize-textarea' => 'A textarea that grows and shrinks to fit its content, with an optional max-rows cap.',
        'file-upload' => 'A drag-and-drop dropzone with image thumbnails, file sizes and per-file progress bars.',
        'color-picker' => 'Accessible colour selection with a hue slider, a validating hex field and a preset swatch palette.',
        'password-strength' => 'A password field with a live strength meter and an optional requirements checklist.',
        'editable' => 'Click-to-edit inline text that swaps the value for an input, saving on Enter or blur.',

        'card' => 'Displays a card with header, content, and footer.',
        'aspect-ratio' => 'Displays content within a desired ratio.',
        'separator' => 'Visually or semantically separates content.',
        'scroll-area' => 'Augments native scroll functionality for custom, cross-browser styling.',
        'resizable' => 'Accessible resizable panel groups and layouts.',
        'sidebar' => 'A composable, themeable and customizable sidebar component.',
        'accent' => 'Recolors any subtree of BlatUI components from a single accent colour — no per-component props.',

        'avatar' => 'An image element with a fallback for representing the user.',
        'badge' => 'Displays a badge, with semantic status tones (success, warning, danger, info, neutral).',
        'code-block' => 'A dark code panel with an optional filename header and a copy button.',
        'data-table' => 'An interactive table with search, sortable columns, row selection and pagination.',
        'table' => 'A responsive table component.',
        'comparison-table' => 'A data-driven feature comparison table — tiers × features with checks, dashes and values.',
        'carousel' => 'A carousel with motion and swipe.',
        'gallery' => 'A thumbnail grid that opens a full-screen lightbox with keyboard navigation.',
        'video' => 'A styled HTML5 video player with a custom poster and play overlay.',
        'chart' => 'Beautiful charts, built using ApexCharts.',
        'icon' => 'A thin wrapper over Lucide icons that auto-mirrors directional arrows under RTL.',
        'item' => 'A flexible component for displaying content with media, title, and actions.',
        'kbd' => 'Used to display textual user input from the keyboard.',
        'progress' => 'Displays an indicator showing the completion progress of a task — a linear bar or a circular ring.',
        'countdown' => 'A live countdown to a target date — days, hours, minutes and seconds, with an expired state.',
        'timeline' => 'A vertical timeline of events, with dots, connecting lines, icons and timestamps.',
        'terminal' => 'A terminal / console window with traffic-light controls — for command output and code demos.',
        'sparkline' => 'A tiny inline trend line drawn from a data array — for KPI cards, tables and stats.',
        'skeleton' => 'Use to show a placeholder while content is loading.',

        'alert' => 'Displays a callout for user attention, with semantic status tones.',
        'banner' => 'A full-width, dismissible announcement bar with semantic tones.',
        'marquee' => 'A seamless, infinite scroll of its content — logos, testimonials, badges.',
        'typewriter' => 'Types and deletes a cycling list of words — for hero headlines and taglines.',
        'text-reveal' => 'Brightens its words one by one as the element scrolls up through the viewport.',
        'quote' => 'A styled blockquote / testimonial with optional author, role and avatar.',
        'empty' => 'An empty state for when there is no data to display.',
        'spinner' => 'An animated loading indicator.',
        'sonner' => 'An opinionated toast notification component. Includes a sonner-flash bridge that turns Laravel session flashes into toasts.',
        'tooltip' => 'A popup that displays information related to an element when hovered or focused.',
        'hover-card' => 'For sighted users to preview content available behind a link.',

        'dialog' => 'A window overlaid on the primary window, rendering the content underneath inert.',
        'alert-dialog' => 'A modal dialog that interrupts the user with important content and expects a response.',
        'sheet' => 'Extends the dialog to display content that complements the main content of the screen.',
        'drawer' => 'A drawer component that slides in from the edge of the screen.',
        'popover' => 'Displays rich content in a portal, triggered by a button.',
        'dropdown-menu' => 'Displays a menu of actions or functions, triggered by a button.',
        'context-menu' => 'Displays a menu located at the pointer, triggered by a right click.',
        'menubar' => 'A visually persistent menu common in desktop applications.',
        'command' => 'Fast, composable, command menu for your app.',
        'command-dialog' => 'A command menu rendered inside a dialog.',

        'breadcrumb' => 'Displays the path to the current resource using a hierarchy of links.',
        'link' => 'An inline, prose-friendly text link with default, muted and subtle variants.',
        'tabs' => 'A set of layered sections of content displayed one panel at a time.',
        'navigation-menu' => 'A collection of links for navigating websites.',
        'pagination' => 'Pagination with page navigation, next and previous links.',
        'stepper' => 'Guides users through a multi-step flow — horizontal or vertical, with completed-step checks.',
        'typography' => 'Prose text styles — headings, lead, blockquote, lists, inline code and more, via a single variant prop.',

        'accordion' => 'A vertically stacked set of interactive headings that each reveal a section of content.',
        'collapsible' => 'An interactive component which expands and collapses a panel.',

        'description-list' => 'A semantic key/value list (term/description) — horizontal or vertical, with an optional bordered style.',
        'stat' => 'A KPI metric card with a label, big value, trend arrow with change, optional icon and inline sparkline.',
        'tree' => 'A collapsible, keyboard-navigable hierarchical tree view with folder and file icons.',
        'json-viewer' => 'A collapsible, syntax-highlighted JSON tree with per-node expand/collapse and copy.',
        'chat' => 'A composable chat transcript — role-aware message bubbles with avatars, names, timestamps and a typing indicator.',
        'prompt-input' => 'An AI chat composer with an auto-growing textarea, attach and send buttons, and ⌘↵ to send.',
        'streaming-text' => 'Reveals a passage token-by-token, LLM-style, with a blinking caret that stops when complete.',
        'reasoning' => 'A collapsible AI reasoning / "thinking" block that reveals the chain-of-thought behind an answer.',
        'tool-call' => 'A card showing an AI tool invocation — name, status, and collapsible JSON arguments and result.',
        'citation' => 'An inline, LLM-style source reference that reveals the source title, link and snippet in a popover.',
    ],

    // Bold footgun callouts rendered above a component's examples. HTML allowed (trusted config).
    'notes' => [
        'button' => [
            'Buttons default to <strong><code>type="button"</code></strong> — a deliberate default. Inside a <code>&lt;form&gt;</code>, set <code>type="submit"</code> on the submit button, or a native button migrated with no <code>type</code> will silently <strong>stop submitting</strong>. Run <code>php artisan blatui:doctor</code> to catch typeless buttons in forms.',
        ],
        'dropdown-menu' => [
            'A <code>dropdown-menu-item</code> renders <strong><code>type="button"</code></strong> by default. To submit the surrounding form from a menu item, pass <code>type="submit"</code> (or <code>href</code> to navigate).',
        ],
        'field' => [
            'Building a custom DX layer that re-wraps a slot with an <code>@aware</code> anonymous component? <code>&lt;x-ui.*&gt;</code> passed as that slot\'s content stays <strong>literal</strong> (it never compiles) — the field is silently absent though the page still returns 200. In such layers, render raw elements styled by the foundation utilities (<code>.blat-input .blat-select .blat-checkbox .blat-radio</code>) instead.',
        ],
    ],
];

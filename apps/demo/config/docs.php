<?php

// Drives the docs sidebar + index grouping. Keys are category labels,
// values are ordered component slugs (must match resources/views/components/ui).
return [
    'categories' => [
        'Forms & Input' => [
            'button', 'button-group', 'input', 'input-group', 'input-otp', 'textarea',
            'label', 'field', 'checkbox', 'radio-group', 'switch', 'select', 'combobox',
            'slider', 'toggle', 'toggle-group', 'calendar', 'date-picker',
        ],
        'Layout' => [
            'card', 'aspect-ratio', 'separator', 'scroll-area', 'resizable', 'sidebar',
        ],
        'Data Display' => [
            'avatar', 'badge', 'table', 'carousel', 'chart', 'item', 'kbd', 'progress', 'skeleton',
        ],
        'Feedback' => [
            'alert', 'empty', 'spinner', 'sonner', 'tooltip', 'hover-card',
        ],
        'Overlays' => [
            'dialog', 'alert-dialog', 'sheet', 'drawer', 'popover', 'dropdown-menu',
            'context-menu', 'menubar', 'command', 'command-dialog',
        ],
        'Navigation' => [
            'breadcrumb', 'tabs', 'navigation-menu', 'pagination',
        ],
        'Disclosure' => [
            'accordion', 'collapsible',
        ],
    ],

    // Optional one-line descriptions shown on each component page.
    'descriptions' => [
        'button' => 'Displays a button or a component that looks like a button.',
        'button-group' => 'Groups related buttons together with consistent styling.',
        'input' => 'Displays a form input field or a component that looks like an input field.',
        'input-group' => 'Group inputs with text, buttons, icons, and more.',
        'input-otp' => 'Accessible one-time password component with copy-paste functionality.',
        'textarea' => 'Displays a form textarea or a component that looks like a textarea.',
        'label' => 'Renders an accessible label associated with controls.',
        'field' => 'Combine labels, controls, and help text to compose accessible form fields.',
        'checkbox' => 'A control that allows the user to toggle between checked and not checked.',
        'radio-group' => 'A set of checkable buttons where no more than one can be checked at a time.',
        'switch' => 'A control that allows the user to toggle between an on and off state.',
        'select' => 'Displays a list of options for the user to pick from, triggered by a button.',
        'combobox' => 'Autocomplete input and command palette with a list of suggestions.',
        'slider' => 'An input where the user selects a value from within a given range.',
        'toggle' => 'A two-state button that can be either on or off.',
        'toggle-group' => 'A set of two-state buttons that can be toggled on or off.',
        'calendar' => 'A date field component that allows users to enter and edit dates.',
        'date-picker' => 'A date picker component with a calendar popover.',

        'card' => 'Displays a card with header, content, and footer.',
        'aspect-ratio' => 'Displays content within a desired ratio.',
        'separator' => 'Visually or semantically separates content.',
        'scroll-area' => 'Augments native scroll functionality for custom, cross-browser styling.',
        'resizable' => 'Accessible resizable panel groups and layouts.',
        'sidebar' => 'A composable, themeable and customizable sidebar component.',

        'avatar' => 'An image element with a fallback for representing the user.',
        'badge' => 'Displays a badge or a component that looks like a badge.',
        'table' => 'A responsive table component.',
        'carousel' => 'A carousel with motion and swipe.',
        'chart' => 'Beautiful charts, built using ApexCharts.',
        'item' => 'A flexible component for displaying content with media, title, and actions.',
        'kbd' => 'Used to display textual user input from the keyboard.',
        'progress' => 'Displays an indicator showing the completion progress of a task.',
        'skeleton' => 'Use to show a placeholder while content is loading.',

        'alert' => 'Displays a callout for user attention.',
        'empty' => 'An empty state for when there is no data to display.',
        'spinner' => 'An animated loading indicator.',
        'sonner' => 'An opinionated toast notification component.',
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
        'tabs' => 'A set of layered sections of content displayed one panel at a time.',
        'navigation-menu' => 'A collection of links for navigating websites.',
        'pagination' => 'Pagination with page navigation, next and previous links.',

        'accordion' => 'A vertically stacked set of interactive headings that each reveal a section of content.',
        'collapsible' => 'An interactive component which expands and collapses a panel.',
    ],
];

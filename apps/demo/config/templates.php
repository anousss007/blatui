<?php

// Full-page TEMPLATES — a tier above blocks: complete, real-world pages assembled
// from many components. The index auto-discovers resources/views/templates/*.blade.php
// and renders only the slugs that have a file; this manifest drives order, grouping,
// titles and descriptions. Categories are shown in listed order.
return [
    'categories' => [
        'Marketing' => [
            'saas' => [
                'title' => 'SaaS Landing',
                'description' => 'A complete product landing — hero, logo wall, features, pricing, testimonials and FAQ.',
            ],
            'agency' => [
                'title' => 'Creative Agency',
                'description' => 'A studio site with services, work showcase, team and a contact form.',
            ],
            'startup' => [
                'title' => 'Startup / Waitlist',
                'description' => 'A focused pre-launch page with a waitlist form and social proof.',
            ],
        ],

        'Commerce' => [
            'store' => [
                'title' => 'E-commerce Storefront',
                'description' => 'A shoppable storefront — filters, product grid, quick-view and a cart drawer.',
            ],
            'product' => [
                'title' => 'Product Detail',
                'description' => 'A product page with gallery, variants, reviews and add-to-cart.',
            ],
            'pricing' => [
                'title' => 'Pricing & Plans',
                'description' => 'Tiered pricing with a billing toggle, comparison table and FAQ.',
            ],
        ],

        'Content' => [
            'blog' => [
                'title' => 'Blog / Magazine',
                'description' => 'A magazine home with a featured story, article grid and newsletter.',
            ],
            'docs-site' => [
                'title' => 'Documentation',
                'description' => 'A docs layout with sidebar navigation, on-this-page and content.',
            ],
            'help-center' => [
                'title' => 'Help Center',
                'description' => 'A support hub with search, categories and popular articles.',
            ],
        ],

        'Application' => [
            'dashboard' => [
                'title' => 'Analytics Dashboard',
                'description' => 'An app shell with sidebar, KPI cards, charts and a data table.',
            ],
            'crm' => [
                'title' => 'CRM / Projects',
                'description' => 'A project workspace with a board, tables, filters and dialogs.',
            ],
            'account' => [
                'title' => 'Account & Settings',
                'description' => 'A settings area with tabbed forms, switches and a danger zone.',
            ],
            'auth' => [
                'title' => 'Authentication',
                'description' => 'A split-screen sign-in / sign-up with a testimonial panel.',
            ],
        ],

        'Events' => [
            'event' => [
                'title' => 'Conference / Event',
                'description' => 'An event page with schedule, speakers, tickets and FAQ.',
            ],
        ],
    ],
];

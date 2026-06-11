<?php

// Full-page TEMPLATES — a tier above blocks: complete, real-world pages assembled
// from many components. The index auto-discovers resources/views/templates/*.blade.php
// and renders only the slugs that have a file; this manifest drives order, grouping,
// titles and descriptions. Categories are shown in listed order.
return [
    'categories' => [
        // Showcase tier — deliberately extravagant, each in a distinct bold visual style,
        // pushing the component library as far as it goes. Self-contained art-directed pages.
        'Showcase' => [
            'aurora' => [
                'title' => 'Aurora — AI Workspace',
                'description' => 'Dark glassmorphism with animated aurora gradients and neon glow — frosted glass, a bento feature grid, live charts and a ⌘K palette.',
            ],
            'quantum' => [
                'title' => 'Quantum — Web3 Dashboard',
                'description' => 'A neon-futurist crypto dashboard on a glowing grid — KPI cards, area/donut charts, a markets table, staking and an onboarding stepper.',
            ],
            'cosmos' => [
                'title' => 'Cosmos — Space Tourism',
                'description' => 'A cinematic space-travel landing — a twinkling starfield, a glowing planet, a live launch countdown, destination tabs, a booking stepper and crew.',
            ],
            'vinyl' => [
                'title' => 'Vinyl — Music Festival',
                'description' => 'A vibrant retro-editorial festival poster — spinning vinyl, line-up with bios, a now-playing player, schedule, tickets and a photo gallery.',
            ],
            'arcade' => [
                'title' => 'Arcade — Game Studio',
                'description' => 'A Y2K vaporwave game studio — a neon perspective grid, chrome text, featured games, a leaderboard, achievements and membership tiers.',
            ],
            'forge' => [
                'title' => 'Forge — Developer Platform',
                'description' => 'A dark terminal-aesthetic dev tool — a typed terminal window, multi-language code tabs, a ⌘K command palette, metrics and pricing.',
            ],
            'brut' => [
                'title' => 'Brut — Creative Studio',
                'description' => 'Neo-brutalist studio portfolio — thick black borders, hard offset shadows, huge type, marquee tickers, a work grid and a project log.',
            ],
            'atelier' => [
                'title' => 'Atelier — Fashion Lookbook',
                'description' => 'A high-fashion editorial lookbook — oversized serif type, a grayscale magazine grid with hover colour-reveal, a runway carousel and the edit.',
            ],
            'terroir' => [
                'title' => 'Terroir — Fine Dining',
                'description' => 'An editorial-serif luxury restaurant page — drop caps, pull quotes, a tabbed menu, chef story, dish gallery and an elegant reservation form.',
            ],
            'bloom' => [
                'title' => 'Bloom — Wellness App',
                'description' => 'A claymorphism wellness landing — soft puffy 3D cards, pastel blobs, progress rings, a habit tracker calendar and a how-it-works stepper.',
            ],
        ],

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

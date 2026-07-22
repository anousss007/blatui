@php
    /* ============================================================
     *  HELIX — Futuristic Biotech / Science Startup template
     * ============================================================ */

    // ── NAV ──────────────────────────────────────────────────────
    $navLinks = [
        'Platform'   => '#platform',
        'Pipeline'   => '#pipeline',
        'Data'       => '#data',
        'Team'       => '#team',
        'Publications' => '#publications',
        'Investors'  => '#investors',
    ];

    // ── HERO BADGES ──────────────────────────────────────────────
    $heroBadges = [
        'CRISPR-based editing',
        'Cell & gene therapy',
        'AI-driven discovery',
        'Series B — $210M',
    ];

    // ── PLATFORM / BENTO CARDS ───────────────────────────────────
    $platform = [
        ['icon' => 'dna', 'title' => 'Genomic Precision', 'desc' => 'Base-editing at single-nucleotide resolution with <0.01% off-target events, validated across 2,400 targets.', 'tag' => 'Core tech', 'col' => 'lg:col-span-2'],
        ['icon' => 'flask-conical', 'title' => 'Cell Engineering', 'desc' => 'Scalable CAR-T and iPSC manufacturing pipelines from concept to GMP batch in under 14 weeks.', 'tag' => 'Manufacturing', 'col' => ''],
        ['icon' => 'brain-circuit', 'title' => 'AI Discovery Engine', 'desc' => 'Proprietary ML models trained on 38 billion protein-sequence pairs predict therapeutic target druggability.', 'tag' => 'AI / ML', 'col' => ''],
        ['icon' => 'shield-check', 'title' => 'Safety-by-Design', 'desc' => 'Every candidate passes our 7-layer genotoxicity screen before entering the development queue.', 'tag' => 'Safety', 'col' => ''],
        ['icon' => 'microscope', 'title' => 'In-House CRO', 'desc' => 'Full-service preclinical suite: in vitro, in vivo, 14 species, bio-analytics, and regulatory documentation.', 'tag' => 'Preclinical', 'col' => 'lg:col-span-2'],
    ];

    // ── PIPELINE (stepper) ────────────────────────────────────────
    $pipeline = [
        [
            'phase'    => 'Discovery',
            'code'     => 'HLX-001',
            'target'   => 'PCSK9 (Hypercholesterolaemia)',
            'status'   => 'active',
            'pct'      => 100,
            'note'     => 'Lead candidate selected',
        ],
        [
            'phase'    => 'Preclinical',
            'code'     => 'HLX-002',
            'target'   => 'ANGPTL3 (Hypertriglyceridaemia)',
            'status'   => 'active',
            'pct'      => 80,
            'note'     => 'NHP tox study Q3 2026',
        ],
        [
            'phase'    => 'IND-enabling',
            'code'     => 'HLX-003',
            'target'   => 'TTR (Transthyretin amyloidosis)',
            'status'   => 'active',
            'pct'      => 55,
            'note'     => 'IND filing expected Q1 2027',
        ],
        [
            'phase'    => 'Phase I',
            'code'     => 'HLX-004',
            'target'   => 'ATTR-CM (Cardiomyopathy)',
            'status'   => 'upcoming',
            'pct'      => 20,
            'note'     => 'Dose escalation planned',
        ],
        [
            'phase'    => 'Phase II/III',
            'code'     => 'HLX-005',
            'target'   => 'SCD-1 (Sickle Cell Disease)',
            'status'   => 'upcoming',
            'pct'      => 0,
            'note'     => 'Partnership discussion',
        ],
    ];

    // ── CHARTS ────────────────────────────────────────────────────
    // Line / area chart: trial efficacy over months
    $trialSeries = [
        ['name' => 'HLX-002 (treated)', 'data' => [12, 28, 44, 61, 74, 82, 87, 91, 93]],
        ['name' => 'Placebo',           'data' => [10, 11, 12, 13, 12, 14, 13, 14, 15]],
    ];
    $trialOptions = [
        'xaxis' => ['categories' => ['M1', 'M2', 'M3', 'M4', 'M5', 'M6', 'M7', 'M8', 'M9']],
        'stroke' => ['width' => 3, 'curve' => 'smooth'],
        'fill'   => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.35, 'opacityTo' => 0.02, 'stops' => [0, 100]]],
        'yaxis'  => ['max' => 100],
        'legend' => ['position' => 'top'],
        'grid'   => ['borderColor' => '#1e3a5f'],
    ];
    $trialColors = ['#2dd4ff', '#7c5cff'];

    // Bar chart: off-target events vs competitors
    $otSeries = [
        ['name' => 'Off-target events', 'data' => [0.008, 0.21, 0.54, 0.38]],
    ];
    $otOptions = [
        'xaxis'       => ['categories' => ['Helix HLX', 'BE-Classic', 'Prime-Edit', 'Cas9-wt']],
        'plotOptions' => ['bar' => ['borderRadius' => 6, 'columnWidth' => '52%']],
        'yaxis'       => ['decimalsInFloat' => 3],
        'grid'        => ['borderColor' => '#1e3a5f'],
        'dataLabels'  => ['enabled' => false],
    ];
    $otColors = ['#34e7b0'];

    // ── TEAM ─────────────────────────────────────────────────────
    $team = [
        ['name' => 'Dr. Amara Osei', 'role' => 'CEO & Co-founder', 'field' => 'Molecular biology, Harvard PhD', 'img' => 'https://picsum.photos/seed/helix-team1/200/200', 'pubs' => 42, 'hindex' => 19],
        ['name' => 'Dr. Lena Voss',  'role' => 'CSO',              'field' => 'CRISPR engineering, MIT post-doc', 'img' => 'https://picsum.photos/seed/helix-team2/200/200', 'pubs' => 67, 'hindex' => 24],
        ['name' => 'Dr. Jin-Ho Park','role' => 'CTO',              'field' => 'Computational biology, Stanford PhD', 'img' => 'https://picsum.photos/seed/helix-team3/200/200', 'pubs' => 31, 'hindex' => 15],
        ['name' => 'Dr. Sofia Reyes','role' => 'VP Clinical',      'field' => 'Gene therapy trials, UCSF', 'img' => 'https://picsum.photos/seed/helix-team4/200/200', 'pubs' => 28, 'hindex' => 12],
        ['name' => 'Dr. Karim Nabil','role' => 'VP Discovery',     'field' => 'Protein engineering, Pasteur', 'img' => 'https://picsum.photos/seed/helix-team5/200/200', 'pubs' => 53, 'hindex' => 21],
        ['name' => 'Dr. Priya Mehta','role' => 'Chief Science Officer Emeritus', 'field' => 'Genomics & bioinformatics', 'img' => 'https://picsum.photos/seed/helix-team6/200/200', 'pubs' => 89, 'hindex' => 33],
    ];

    // ── PUBLICATIONS ─────────────────────────────────────────────
    $publications = [
        ['title' => 'Single-base editing with sub-0.01% off-target frequency in primary human cells', 'journal' => 'Nature Biotechnology', 'year' => 2026, 'doi' => '10.1038/nbt.xxxxx', 'impact' => 46.9, 'type' => 'Research article'],
        ['title' => 'AI-guided target identification accelerates rare-disease candidate selection', 'journal' => 'Cell', 'year' => 2025, 'doi' => '10.1016/j.cell.xxxxxx', 'impact' => 64.5, 'type' => 'Research article'],
        ['title' => 'GMP-scale iPSC-derived CAR-T manufacturing: a 14-week protocol', 'journal' => 'Nature Methods', 'year' => 2025, 'doi' => '10.1038/nmeth.xxxxx', 'impact' => 48.0, 'type' => 'Protocol'],
        ['title' => 'In vivo TTR silencing with lipid-nanoparticle-delivered base editors', 'journal' => 'NEJM', 'year' => 2025, 'doi' => '10.1056/NEJMoa.xxxxx', 'impact' => 176.1, 'type' => 'Clinical brief'],
        ['title' => 'Safety-by-design: a 7-layer genotoxicity screening framework', 'journal' => 'Nature Medicine', 'year' => 2024, 'doi' => '10.1038/nm.xxxxx', 'impact' => 82.9, 'type' => 'Methods'],
    ];

    // ── PARTNERS (marquee) ────────────────────────────────────────
    $partners = ['Roche', 'GSK', 'Moderna', 'BioNTech', 'AstraZeneca', 'Novartis', 'Pfizer', 'Sanofi', 'Illumina', 'BROAD Institute'];

    // ── PROCESS TABS ─────────────────────────────────────────────
    $process = [
        'identify' => [
            'label'  => 'Identify',
            'icon'   => 'search',
            'title'  => 'AI-powered target identification',
            'desc'   => 'Our HelixAI engine ingests multi-omics datasets from 180,000+ patient samples, ranks druggable targets by therapeutic index, and de-risks early pipeline decisions.',
            'points' => ['Multi-omics data fusion', 'Therapeutic index ranking', 'Competitive landscape mapping'],
            'img'    => 'https://picsum.photos/seed/helix-proc1/800/500',
        ],
        'engineer' => [
            'label'  => 'Engineer',
            'icon'   => 'dna',
            'title'  => 'Precision base editing',
            'desc'   => 'Our proprietary editors achieve single-nucleotide resolution across diverse cell types. Automated delivery optimisation selects the best LNP or viral vector for each candidate.',
            'points' => ['Single-nucleotide precision', 'LNP + AAV delivery', 'Off-target <0.01%'],
            'img'    => 'https://picsum.photos/seed/helix-proc2/800/500',
        ],
        'validate' => [
            'label'  => 'Validate',
            'icon'   => 'flask-conical',
            'title'  => 'Rapid in vivo validation',
            'desc'   => 'A fully in-house preclinical suite compresses the path from lead candidate to IND-enabling package from 3 years to under 9 months via parallel study execution.',
            'points' => ['In-house GLP toxicology', 'Parallel multi-species studies', 'Integrated bioanalytics'],
            'img'    => 'https://picsum.photos/seed/helix-proc3/800/500',
        ],
        'develop' => [
            'label'  => 'Develop',
            'icon'   => 'activity',
            'title'  => 'Clinical development',
            'desc'   => 'Helix operates as its own CRO for Phase I/II. Real-time genomic biomarker monitoring enables adaptive dose decisions and faster regulatory milestones.',
            'points' => ['Adaptive trial design', 'Genomic biomarker suite', 'FDA/EMA alignment'],
            'img'    => 'https://picsum.photos/seed/helix-proc4/800/500',
        ],
    ];

    // ── INVESTORS / CTA STATS ─────────────────────────────────────
    $investors = ['a16z Bio', 'Foresite Capital', 'ARCH Venture', 'GV', 'Nextech Invest'];

    $ctaStats = [
        ['v' => '5',     'l' => 'Pipeline candidates'],
        ['v' => '$210M', 'l' => 'Series B raised'],
        ['v' => '180+',  'l' => 'Peer-reviewed papers'],
        ['v' => '14wk',  'l' => 'Cell mfg cycle time'],
    ];

    // ── FAQ ──────────────────────────────────────────────────────
    $faqs = [
        ['q' => 'What makes Helix\'s base editing different from first-generation approaches?',
         'a' => 'Our HelixEdit platform couples an optimised cytosine/adenine base editor with a proprietary guide-RNA design algorithm. The result is sub-0.01% off-target frequency — over 20× better than published Cas9 benchmarks — validated in primary human hepatocytes, HSCs, and T cells.'],
        ['q' => 'How does Helix protect against unintended bystander edits?',
         'a' => 'Every target undergoes our 7-layer bystander screen: in silico prediction, amplicon-seq, Digenome-seq, CIRCLE-seq, GUIDE-seq, long-read WGS, and blinded third-party validation. Only candidates clearing all seven gates advance.'],
        ['q' => 'What is Helix\'s manufacturing strategy?',
         'a' => 'We run a fully integrated GMP facility in Cambridge, MA capable of producing autologous and allogeneic cell products. Our 14-week iPSC-to-infusion protocol has been validated for CAR-T, CAR-NK, and HSC programs.'],
        ['q' => 'Does Helix partner or out-license its technology?',
         'a' => 'Yes. We offer research licenses, co-development agreements, and full program acquisitions. Our partnership team can typically structure a term sheet within 8 weeks of first contact. Reach out at partnerships@helixbio.example.'],
        ['q' => 'When do you expect the first IND filing?',
         'a' => 'HLX-003 (TTR amyloidosis) is on track for an IND filing in Q1 2027, with HLX-004 (ATTR-CM) entering Phase I dose escalation shortly after, pending FDA feedback.'],
    ];

    // ── FOOTER ───────────────────────────────────────────────────
    $footer = [
        'Science'   => ['Platform', 'Pipeline', 'Publications', 'Patents', 'Open data'],
        'Company'   => ['About', 'Careers', 'Press', 'Partners', 'Contact'],
        'Investors' => ['Investor relations', 'Annual report', 'ESG', 'Governance'],
        'Legal'     => ['Privacy', 'Terms', 'Cookie policy', 'Compliance'],
    ];
@endphp

<x-layouts.app title="Helix — Engineering biology">

{{-- ═══════════════════════════════════════════════════════════════
     HELIX — own dark theme, scoped under #tpl-helix
     ═══════════════════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap');

/* ── Tokens ─────────────────────────────────────────────── */
#tpl-helix {
    --hx-navy:     #0a1628;
    --hx-navy2:    #0b1e3b;
    --hx-blue:     #2dd4ff;
    --hx-violet:   #7c5cff;
    --hx-mint:     #34e7b0;
    --hx-white:    #f0f6ff;
    --hx-subtle:   rgba(45,212,255,0.08);
    --hx-border:   rgba(45,212,255,0.15);
    --hx-card:     rgba(11,30,59,0.85);
    --hx-glow-b:   0 0 40px rgba(45,212,255,0.22);
    --hx-glow-v:   0 0 40px rgba(124,92,255,0.22);
    font-family: 'Inter', 'Space Grotesk', system-ui, sans-serif;
    background: var(--hx-navy);
    color: var(--hx-white);
    overflow-x: hidden;
}

/* ── Typography ─────────────────────────────────────────── */
#tpl-helix h1, #tpl-helix h2, #tpl-helix h3, #tpl-helix h4 {
    font-family: 'Space Grotesk', system-ui, sans-serif;
    color: var(--hx-white);
}
#tpl-helix .hx-mono { font-family: 'Geist Mono', 'Fira Code', monospace; }

/* ── Mesh gradient background ───────────────────────────── */
#tpl-helix .hx-mesh {
    position: absolute; inset: 0; pointer-events: none; z-index: 0; overflow: hidden;
}
#tpl-helix .hx-blob {
    position: absolute; border-radius: 50%; filter: blur(80px); opacity: 0.18;
}
#tpl-helix .hx-blob-1 { width: 700px; height: 700px; background: var(--hx-blue);   top: -200px; left: -180px; }
#tpl-helix .hx-blob-2 { width: 600px; height: 600px; background: var(--hx-violet); top: 100px;  right: -180px; }
#tpl-helix .hx-blob-3 { width: 500px; height: 500px; background: var(--hx-mint);   bottom: -120px; left: 30%; }

/* ── DNA Helix animation ─────────────────────────────────── */
#tpl-helix .helix-wrap {
    position: relative; width: 120px; height: 340px; margin: 0 auto;
}
#tpl-helix .helix-strand {
    position: absolute; width: 100%; height: 100%;
}
#tpl-helix .helix-dot {
    position: absolute; left: 50%; width: 14px; height: 14px;
    border-radius: 50%; transform: translateX(-50%);
    box-shadow: 0 0 10px currentColor;
}
#tpl-helix .helix-rung {
    position: absolute; height: 2px; left: 10%; width: 80%;
    opacity: 0.4; border-radius: 1px;
}
@keyframes helix-bob { 0%,100%{transform:translateY(0)} 50%{transform:translateY(-10px)} }
@keyframes helix-pulse { 0%,100%{opacity:0.6} 50%{opacity:1} }
@keyframes helix-rotate { 0%{transform:rotateY(0deg)} 100%{transform:rotateY(360deg)} }
#tpl-helix .helix-scene {
    animation: helix-bob 6s ease-in-out infinite;
}
@media (prefers-reduced-motion: reduce) {
    #tpl-helix .helix-scene, #tpl-helix .helix-scene * { animation: none !important; }
}

/* ── Glow cards ─────────────────────────────────────────── */
#tpl-helix .hx-card {
    background: var(--hx-card);
    border: 1px solid var(--hx-border);
    border-radius: 1rem;
    backdrop-filter: blur(12px);
    -webkit-backdrop-filter: blur(12px);
    transition: box-shadow 0.3s, border-color 0.3s;
}
#tpl-helix .hx-card:hover {
    box-shadow: var(--hx-glow-b);
    border-color: rgba(45,212,255,0.35);
}
#tpl-helix .hx-card-violet:hover {
    box-shadow: var(--hx-glow-v);
    border-color: rgba(124,92,255,0.40);
}

/* ── Glow button ─────────────────────────────────────────── */
#tpl-helix .hx-btn-primary {
    background: linear-gradient(135deg, var(--hx-blue), var(--hx-violet));
    color: #fff; border: none; border-radius: 0.5rem; font-weight: 600;
    box-shadow: 0 0 20px rgba(45,212,255,0.25);
    transition: box-shadow 0.2s, opacity 0.2s;
}
#tpl-helix .hx-btn-primary:hover { box-shadow: 0 0 32px rgba(45,212,255,0.45); opacity: 0.92; }
#tpl-helix .hx-btn-ghost {
    background: var(--hx-subtle); color: var(--hx-blue);
    border: 1px solid var(--hx-border); border-radius: 0.5rem; font-weight: 600;
    transition: background 0.2s;
}
#tpl-helix .hx-btn-ghost:hover { background: rgba(45,212,255,0.15); }

/* ── Badge ───────────────────────────────────────────────── */
#tpl-helix .hx-badge {
    display: inline-flex; align-items: center; gap: 0.3rem;
    padding: 0.2rem 0.65rem; border-radius: 9999px; font-size: 0.7rem; font-weight: 600;
    letter-spacing: 0.04em; text-transform: uppercase;
}
#tpl-helix .hx-badge-blue   { background: rgba(45,212,255,0.12); color: var(--hx-blue);   border: 1px solid rgba(45,212,255,0.25); }
#tpl-helix .hx-badge-violet { background: rgba(124,92,255,0.12); color: var(--hx-violet); border: 1px solid rgba(124,92,255,0.25); }
#tpl-helix .hx-badge-mint   { background: rgba(52,231,176,0.12); color: var(--hx-mint);   border: 1px solid rgba(52,231,176,0.25); }
#tpl-helix .hx-badge-grey   { background: rgba(255,255,255,0.06); color: #94a3b8; border: 1px solid rgba(255,255,255,0.10); }

/* ── Section helpers ──────────────────────────────────────── */
#tpl-helix .hx-section { position: relative; overflow: hidden; }
#tpl-helix .hx-divider { border-color: var(--hx-border); }
#tpl-helix .hx-text-muted { color: rgba(176,200,230,0.7); }
#tpl-helix .hx-gradient-text {
    background: linear-gradient(90deg, var(--hx-blue), var(--hx-violet), var(--hx-mint));
    -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;
}

/* ── Node grid (background pattern) ─────────────────────── */
#tpl-helix .hx-node-grid {
    background-image:
        radial-gradient(circle, rgba(45,212,255,0.12) 1px, transparent 1px);
    background-size: 36px 36px;
}

/* ── Progress glow ───────────────────────────────────────── */
#tpl-helix .hx-progress-track {
    background: rgba(45,212,255,0.10); border-radius: 9999px; overflow: hidden; height: 6px;
}
#tpl-helix .hx-progress-fill {
    height: 100%; border-radius: 9999px;
    background: linear-gradient(90deg, var(--hx-blue), var(--hx-mint));
    box-shadow: 0 0 8px var(--hx-blue);
    transition: width 1s cubic-bezier(0.4,0,0.2,1);
}

/* ── Chart container override for dark bg ──────────────── */
#tpl-helix [data-slot="chart"] {
    background: transparent !important;
}
#tpl-helix .apexcharts-canvas svg { background: transparent !important; }

/* ── Table ───────────────────────────────────────────────── */
#tpl-helix .hx-table thead tr { border-color: var(--hx-border); }
#tpl-helix .hx-table tbody tr { border-color: rgba(45,212,255,0.08); color: rgba(200,220,245,0.85); }
#tpl-helix .hx-table tbody tr:hover { background: rgba(45,212,255,0.04); }
#tpl-helix .hx-table th { color: var(--hx-blue); font-size: 0.7rem; letter-spacing: 0.08em; text-transform: uppercase; font-family: 'Space Grotesk', sans-serif; }

/* ── Marquee partner logos ───────────────────────────────── */
#tpl-helix .hx-partner-pill {
    padding: 0.45rem 1.1rem; border-radius: 9999px; font-weight: 600; font-size: 0.9rem;
    background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.09);
    color: rgba(176,200,230,0.7); white-space: nowrap; letter-spacing: 0.02em;
}

/* ── Accordion override ──────────────────────────────────── */
#tpl-helix [data-slot="accordion-item"] { border-color: var(--hx-border); }
#tpl-helix [data-slot="accordion-trigger"] { color: var(--hx-white); }
#tpl-helix [data-slot="accordion-content"] { color: rgba(176,200,230,0.8); }

/* ── Nav override ────────────────────────────────────────── */
#tpl-helix header {
    background: rgba(10,22,40,0.9);
    border-bottom-color: var(--hx-border);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

/* ── Separator ───────────────────────────────────────────── */
#tpl-helix [data-slot="separator"] { background-color: var(--hx-border); }

/* ── Hover-card dark skin ─────────────────────────────────── */
#tpl-helix [data-slot="hover-card-content"] {
    background: #0d2040; border-color: var(--hx-border); color: var(--hx-white);
}

/* ── Tooltip dark skin ────────────────────────────────────── */
#tpl-helix [data-slot="tooltip-content"] {
    background: var(--hx-violet); color: #fff;
}

/* ── Tabs dark skin ───────────────────────────────────────── */
#tpl-helix [data-slot="tabs-list"] { background: rgba(45,212,255,0.07); border-color: var(--hx-border); }
#tpl-helix [data-slot="tabs-trigger"][data-state="active"] { color: var(--hx-blue); }

/* ── Steps connector line ─────────────────────────────────── */
#tpl-helix .hx-step-line { background: linear-gradient(180deg, var(--hx-blue), var(--hx-violet)); width: 2px; }
</style>

<div id="tpl-helix">

    {{-- ═══ NAV ════════════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-40 border-b">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2.5 shrink-0">
                <span class="flex size-8 items-center justify-center rounded-lg"
                      style="background:linear-gradient(135deg,#2dd4ff,#7c5cff)">
                    <x-lucide-dna class="size-4 text-white" />
                </span>
                <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.15rem;color:#f0f6ff;letter-spacing:0.01em">Helix</span>
                <span class="hx-badge hx-badge-mint hidden sm:inline-flex">BioTech</span>
            </a>

            <nav class="ml-4 hidden items-center gap-0.5 text-sm md:flex">
                @foreach ($navLinks as $label => $href)
                    <a href="{{ $href }}"
                       class="rounded-md px-3 py-1.5 font-medium transition-colors"
                       style="color:rgba(176,200,230,0.75)"
                       onmouseover="this.style.color='#2dd4ff';this.style.background='rgba(45,212,255,0.08)'"
                       onmouseout="this.style.color='rgba(176,200,230,0.75)';this.style.background='transparent'">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                <a href="#investors" class="hx-btn-ghost hidden sm:inline-flex items-center gap-2 px-4 py-2 text-sm">
                    <x-lucide-file-text class="size-4" /> Investor deck
                </a>
                <a href="#pipeline" class="hx-btn-primary hidden sm:inline-flex items-center gap-2 px-4 py-2 text-sm">
                    <x-lucide-flask-conical class="size-4" /> View pipeline
                </a>
                {{-- Mobile sheet --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="md:hidden">
                        <button type="button" class="hx-btn-ghost flex size-9 items-center justify-center rounded-md" aria-label="Open menu">
                            <x-lucide-menu class="size-4" />
                        </button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right" class="border-l" style="background:#0b1e3b;border-color:rgba(45,212,255,0.15)">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title class="hx-gradient-text">Helix</x-ui.sheet-title>
                        </x-ui.sheet-header>
                        <nav class="grid gap-1 px-4 text-sm">
                            @foreach ($navLinks as $label => $href)
                                <a href="{{ $href }}" @click="open=false"
                                   class="rounded-md px-3 py-2 font-medium"
                                   style="color:rgba(176,200,230,0.8)">{{ $label }}</a>
                            @endforeach
                        </nav>
                        <x-ui.sheet-footer>
                            <a href="#pipeline" class="hx-btn-primary flex items-center justify-center gap-2 py-2 text-sm rounded-md w-full">View pipeline</a>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </header>

    {{-- ═══ HERO ══════════════════════════════════════════════════ --}}
    <section class="hx-section hx-node-grid relative pb-20 pt-24 lg:pt-32" style="background:var(--hx-navy)">
        <div class="hx-mesh">
            <div class="hx-blob hx-blob-1"></div>
            <div class="hx-blob hx-blob-2"></div>
            <div class="hx-blob hx-blob-3"></div>
        </div>

        <div class="relative z-10 mx-auto grid max-w-7xl items-center gap-14 px-6 lg:grid-cols-2">
            {{-- Left: copy --}}
            <div>
                <span class="hx-badge hx-badge-blue mb-5 inline-flex">
                    <x-lucide-dna class="size-3" /> Series B — $210M raised
                </span>

                <h1 class="text-4xl font-bold leading-tight tracking-tight sm:text-5xl lg:text-6xl" style="font-family:'Space Grotesk',sans-serif">
                    We engineer<br>
                    <span class="hx-gradient-text">biology</span> at the<br>
                    base level.
                </h1>

                <p class="hx-text-muted mt-5 max-w-lg text-lg leading-relaxed">
                    Helix combines precision base-editing, AI-driven target discovery and
                    integrated GMP manufacturing to build curative genomic medicines.
                </p>

                {{-- CTA row --}}
                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <a href="#pipeline" class="hx-btn-primary inline-flex items-center gap-2 px-6 py-3 text-sm">
                        <x-lucide-flask-conical class="size-4" /> Explore pipeline
                    </a>
                    <a href="#data" class="hx-btn-ghost inline-flex items-center gap-2 px-6 py-3 text-sm">
                        <x-lucide-bar-chart-2 class="size-4" /> See trial data
                    </a>
                </div>

                {{-- Badges row --}}
                <div class="mt-7 flex flex-wrap gap-2">
                    @foreach ($heroBadges as $b)
                        <span class="hx-badge hx-badge-grey">{{ $b }}</span>
                    @endforeach
                </div>

                {{-- Mini stats --}}
                <div class="mt-9 grid grid-cols-3 gap-4" style="border-top:1px solid var(--hx-border);padding-top:1.5rem">
                    @foreach ([['5', 'Pipeline assets'], ['180+', 'Publications'], ['<0.01%', 'Off-target rate']] as [$val, $lbl])
                        <div>
                            <div class="hx-mono text-2xl font-bold" style="color:var(--hx-blue)">{{ $val }}</div>
                            <div class="hx-text-muted text-xs mt-0.5">{{ $lbl }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: animated DNA helix graphic --}}
            <div class="flex justify-center" aria-hidden="true">
                <div class="helix-scene">
                    <div class="helix-wrap" style="perspective:400px">
                        @php
                            $count = 12;
                            $ht = 320;
                        @endphp
                        {{-- Two strands + rungs --}}
                        @for ($i = 0; $i < $count; $i++)
                            @php
                                $angle = $i / $count * 2 * M_PI;
                                $y = (int)round($i / ($count - 1) * ($ht - 14));
                                $x1 = (int)round(50 + 38 * cos($angle));
                                $x2 = (int)round(50 + 38 * cos($angle + M_PI));
                                $even = $i % 2 === 0;
                                $delay = round($i * 0.18, 2);
                            @endphp
                            {{-- Strand A dot --}}
                            <div class="helix-dot" style="top:{{ $y }}px;left:{{ $x1 }}%;color:{{ $even ? '#2dd4ff' : '#7c5cff' }};background:{{ $even ? '#2dd4ff' : '#7c5cff' }};animation:helix-pulse {{ 2 + $i * 0.1 }}s {{ $delay }}s ease-in-out infinite;width:12px;height:12px;margin-left:-6px;"></div>
                            {{-- Strand B dot --}}
                            <div class="helix-dot" style="top:{{ $y }}px;left:{{ $x2 }}%;color:{{ $even ? '#34e7b0' : '#7c5cff' }};background:{{ $even ? '#34e7b0' : '#7c5cff' }};animation:helix-pulse {{ 2.3 + $i * 0.1 }}s {{ $delay }}s ease-in-out infinite;width:12px;height:12px;margin-left:-6px;"></div>
                            {{-- Rung --}}
                            <div class="helix-rung" style="top:{{ $y + 5 }}px;background:linear-gradient(90deg,{{ $even ? '#2dd4ff' : '#7c5cff' }},{{ $even ? '#34e7b0' : '#2dd4ff' }});animation:helix-pulse {{ 3 + $i * 0.05 }}s {{ $delay }}s ease-in-out infinite;"></div>
                        @endfor
                    </div>
                </div>

                {{-- Floating data chips --}}
                <div class="absolute hidden lg:block" style="top:8rem;right:2rem">
                    <div class="hx-card p-3 text-xs space-y-1" style="min-width:150px">
                        <div class="hx-mono" style="color:var(--hx-mint)">EDIT PRECISION</div>
                        <div class="font-bold text-lg" style="color:#fff">&lt;0.01%</div>
                        <div class="hx-text-muted text-xs">off-target frequency</div>
                    </div>
                </div>
                <div class="absolute hidden lg:block" style="bottom:6rem;right:0.5rem">
                    <div class="hx-card p-3 text-xs space-y-1" style="min-width:140px">
                        <div class="hx-mono" style="color:var(--hx-violet)">AI TARGETS</div>
                        <div class="font-bold text-lg" style="color:#fff">2,400+</div>
                        <div class="hx-text-muted text-xs">validated targets</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ PLATFORM BENTO ════════════════════════════════════════ --}}
    <section id="platform" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy2)">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-14">
                <span class="hx-badge hx-badge-violet mb-4 inline-flex">
                    <x-lucide-cpu class="size-3" /> Platform
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Full-stack genomic medicine</h2>
                <p class="hx-text-muted mt-3 text-lg text-balance">Five integrated pillars from discovery to GMP clinic — owned end-to-end.</p>
            </div>

            <div class="grid gap-5 lg:grid-cols-3">
                @foreach ($platform as $p)
                    <div class="hx-card hx-card-violet p-6 {{ $p['col'] }}">
                        <div class="mb-4 inline-flex size-11 items-center justify-center rounded-xl"
                             style="background:rgba(124,92,255,0.15)">
                            <x-dynamic-component :component="'lucide-'.$p['icon']" class="size-5" style="color:var(--hx-violet)" />
                        </div>
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="font-semibold text-base">{{ $p['title'] }}</h3>
                                <p class="hx-text-muted mt-1.5 text-sm leading-relaxed">{{ $p['desc'] }}</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <span class="hx-badge hx-badge-grey">{{ $p['tag'] }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ RESEARCH PIPELINE ══════════════════════════════════════ --}}
    <section id="pipeline" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy)">
        <div class="mx-auto max-w-5xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-14">
                <span class="hx-badge hx-badge-mint mb-4 inline-flex">
                    <x-lucide-activity class="size-3" /> Research pipeline
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">From discovery to clinic</h2>
                <p class="hx-text-muted mt-3 text-lg">Five programs. Two in preclinical. One heading to IND.</p>
            </div>

            <div class="space-y-0">
                @foreach ($pipeline as $idx => $step)
                    @php $last = $idx === count($pipeline) - 1; @endphp
                    <div class="relative flex gap-6">
                        {{-- Vertical connector --}}
                        <div class="flex flex-col items-center">
                            <div class="flex size-10 shrink-0 items-center justify-center rounded-full z-10"
                                 style="background:{{ $step['status'] === 'active' ? 'linear-gradient(135deg,#2dd4ff,#7c5cff)' : 'rgba(45,212,255,0.08)' }};border:2px solid {{ $step['status'] === 'active' ? 'rgba(45,212,255,0.6)' : 'rgba(45,212,255,0.15)' }};box-shadow:{{ $step['status'] === 'active' ? '0 0 16px rgba(45,212,255,0.3)' : 'none' }}">
                                @if ($step['status'] === 'active')
                                    <x-lucide-check class="size-4 text-white" />
                                @else
                                    <x-lucide-clock class="size-4" style="color:rgba(176,200,230,0.4)" />
                                @endif
                            </div>
                            @if (!$last)
                                <div class="hx-step-line flex-1 my-1" style="min-height:2.5rem"></div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="pb-8 flex-1">
                            <div class="hx-card p-5">
                                <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
                                    <div>
                                        <div class="flex items-center gap-2 flex-wrap">
                                            <span class="hx-mono text-xs font-bold" style="color:var(--hx-blue)">{{ $step['code'] }}</span>
                                            <span class="hx-badge {{ $step['status'] === 'active' ? 'hx-badge-mint' : 'hx-badge-grey' }}">{{ $step['phase'] }}</span>
                                        </div>
                                        <h3 class="font-semibold mt-1.5 text-sm">{{ $step['target'] }}</h3>
                                        <p class="hx-text-muted text-xs mt-1">{{ $step['note'] }}</p>
                                    </div>
                                    <span class="hx-mono text-sm font-bold" style="color:{{ $step['pct'] > 0 ? '#2dd4ff' : 'rgba(176,200,230,0.3)' }}">{{ $step['pct'] }}%</span>
                                </div>
                                {{-- Progress bar --}}
                                <div class="hx-progress-track">
                                    <div class="hx-progress-fill" style="width:{{ $step['pct'] }}%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ DATA & RESULTS (charts) ══════════════════════════════ --}}
    <section id="data" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy2)">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-14">
                <span class="hx-badge hx-badge-blue mb-4 inline-flex">
                    <x-lucide-bar-chart-2 class="size-3" /> Data &amp; results
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Outcomes that speak for themselves</h2>
                <p class="hx-text-muted mt-3 text-lg">Phase I/II data from HLX-002 (NHP study) and benchmark comparison across platforms.</p>
            </div>

            <div class="grid gap-6 lg:grid-cols-5">
                {{-- Area chart: trial efficacy --}}
                <div class="hx-card p-6 lg:col-span-3">
                    <div class="mb-4 flex items-center justify-between">
                        <div>
                            <h3 class="font-semibold">HLX-002 — Efficacy vs Placebo</h3>
                            <p class="hx-text-muted text-xs mt-0.5">% LDL-C reduction over 9 months (NHP, n=32)</p>
                        </div>
                        <span class="hx-badge hx-badge-mint">Phase I data</span>
                    </div>
                    <x-ui.chart
                        type="area"
                        :series="$trialSeries"
                        :options="$trialOptions"
                        :colors="$trialColors"
                        :height="240"
                        label="HLX-002 trial efficacy chart"
                        class="w-full"
                    />
                </div>

                {{-- Bar chart: off-target comparison --}}
                <div class="hx-card p-6 lg:col-span-2">
                    <div class="mb-4">
                        <h3 class="font-semibold">Off-target frequency</h3>
                        <p class="hx-text-muted text-xs mt-0.5">% mean off-target events vs. platforms</p>
                    </div>
                    <x-ui.chart
                        type="bar"
                        :series="$otSeries"
                        :options="$otOptions"
                        :colors="$otColors"
                        :height="240"
                        label="Off-target frequency comparison bar chart"
                        class="w-full"
                    />
                </div>
            </div>

            {{-- Key metrics row --}}
            <div class="mt-8 grid grid-cols-2 gap-4 sm:grid-cols-4">
                @foreach ([['93%', 'Max LDL-C reduction', 'blue'], ['0.008%', 'Off-target rate', 'mint'], ['32', 'NHP subjects', 'violet'], ['9 mo', 'Durable response', 'blue']] as [$v, $l, $c])
                    <div class="hx-card p-5 text-center">
                        <div class="hx-mono text-2xl font-bold" style="color:var(--hx-{{ $c }})">{{ $v }}</div>
                        <div class="hx-text-muted text-xs mt-1">{{ $l }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ TEAM ═══════════════════════════════════════════════════ --}}
    <section id="team" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy)">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-14">
                <span class="hx-badge hx-badge-violet mb-4 inline-flex">
                    <x-lucide-users class="size-3" /> Scientific team
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Built by the world's top genomicists</h2>
                <p class="hx-text-muted mt-3 text-lg">Hover any card to see their publication record.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($team as $member)
                    <x-ui.hover-card>
                        <x-ui.hover-card-trigger>
                            <div class="hx-card hx-card-violet p-6 flex items-start gap-4 cursor-default transition-all">
                                <x-ui.avatar class="size-14 shrink-0">
                                    <x-ui.avatar-image src="{{ $member['img'] }}" alt="{{ $member['name'] }}" />
                                    <x-ui.avatar-fallback style="background:rgba(124,92,255,0.2);color:var(--hx-violet)">
                                        {{ strtoupper(substr($member['name'], 3, 1)) }}
                                    </x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div class="min-w-0">
                                    <h3 class="font-semibold text-sm leading-tight">{{ $member['name'] }}</h3>
                                    <p class="text-xs mt-0.5" style="color:var(--hx-blue)">{{ $member['role'] }}</p>
                                    <p class="hx-text-muted text-xs mt-1 leading-snug">{{ $member['field'] }}</p>
                                </div>
                            </div>
                        </x-ui.hover-card-trigger>
                        <x-ui.hover-card-content class="w-72">
                            <div class="space-y-3">
                                <div class="flex items-center gap-3">
                                    <x-ui.avatar class="size-10">
                                        <x-ui.avatar-image src="{{ $member['img'] }}" alt="{{ $member['name'] }}" />
                                        <x-ui.avatar-fallback>{{ substr($member['name'], 3, 1) }}</x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                    <div>
                                        <p class="font-semibold text-sm" style="color:#f0f6ff">{{ $member['name'] }}</p>
                                        <p class="text-xs" style="color:rgba(176,200,230,0.6)">{{ $member['role'] }}</p>
                                    </div>
                                </div>
                                <x-ui.separator />
                                <div class="grid grid-cols-2 gap-2 text-center">
                                    <div>
                                        <div class="hx-mono font-bold" style="color:#2dd4ff">{{ $member['pubs'] }}</div>
                                        <div class="text-xs" style="color:rgba(176,200,230,0.6)">Publications</div>
                                    </div>
                                    <div>
                                        <div class="hx-mono font-bold" style="color:#34e7b0">h-{{ $member['hindex'] }}</div>
                                        <div class="text-xs" style="color:rgba(176,200,230,0.6)">h-index</div>
                                    </div>
                                </div>
                            </div>
                        </x-ui.hover-card-content>
                    </x-ui.hover-card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ PUBLICATIONS TABLE ════════════════════════════════════ --}}
    <section id="publications" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy2)">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-14">
                <span class="hx-badge hx-badge-mint mb-4 inline-flex">
                    <x-lucide-book-open class="size-3" /> Publications
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Peer-reviewed science</h2>
                <p class="hx-text-muted mt-3 text-lg">180+ publications. Selected highlights from 2024–2026.</p>
            </div>

            <div class="hx-card overflow-hidden">
                <x-ui.table class="hx-table">
                    <x-ui.table-header>
                        <x-ui.table-row>
                            <x-ui.table-head class="pl-5">Title</x-ui.table-head>
                            <x-ui.table-head>Journal</x-ui.table-head>
                            <x-ui.table-head>Type</x-ui.table-head>
                            <x-ui.table-head class="text-right pr-5">IF</x-ui.table-head>
                        </x-ui.table-row>
                    </x-ui.table-header>
                    <x-ui.table-body>
                        @foreach ($publications as $pub)
                            <x-ui.table-row>
                                <x-ui.table-cell class="pl-5 max-w-sm">
                                    <div class="font-medium text-sm leading-snug" style="color:#f0f6ff">{{ $pub['title'] }}</div>
                                    <div class="hx-mono text-xs mt-0.5" style="color:rgba(176,200,230,0.45)">DOI: {{ $pub['doi'] }} · {{ $pub['year'] }}</div>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <span class="hx-badge hx-badge-blue text-xs">{{ $pub['journal'] }}</span>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <span class="hx-badge hx-badge-grey">{{ $pub['type'] }}</span>
                                </x-ui.table-cell>
                                <x-ui.table-cell class="text-right pr-5">
                                    <x-ui.tooltip>
                                        <x-ui.tooltip-trigger>
                                            <span class="hx-mono font-bold text-sm cursor-default" style="color:var(--hx-mint)">{{ $pub['impact'] }}</span>
                                        </x-ui.tooltip-trigger>
                                        <x-ui.tooltip-content side="left">Impact factor {{ $pub['impact'] }}</x-ui.tooltip-content>
                                    </x-ui.tooltip>
                                </x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    </x-ui.table-body>
                </x-ui.table>
            </div>
        </div>
    </section>

    {{-- ═══ PARTNERS MARQUEE ══════════════════════════════════════ --}}
    <section class="hx-section border-y py-12" style="background:var(--hx-navy);border-color:var(--hx-border)">
        <p class="hx-text-muted mb-6 text-center text-sm tracking-wide uppercase text-xs">Strategic partners &amp; collaborators</p>
        <x-ui.marquee fade :duration="'38s'" class="mx-auto max-w-5xl">
            @foreach ($partners as $name)
                <span class="hx-partner-pill mx-2">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ═══ PROCESS TABS ═══════════════════════════════════════════ --}}
    <section class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy2)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center mb-12">
                <span class="hx-badge hx-badge-blue mb-4 inline-flex">
                    <x-lucide-workflow class="size-3" /> Our process
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">How we build medicines</h2>
            </div>

            <x-ui.tabs value="identify" class="w-full">
                <x-ui.tabs-list variant="underline" class="mx-auto max-w-2xl">
                    @foreach ($process as $key => $tab)
                        <x-ui.tabs-trigger value="{{ $key }}">
                            <x-dynamic-component :component="'lucide-'.$tab['icon']" class="size-4" />
                            {{ $tab['label'] }}
                        </x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($process as $key => $tab)
                    <x-ui.tabs-content value="{{ $key }}" class="mt-8">
                        <div class="hx-card p-8 grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <div class="inline-flex size-12 items-center justify-center rounded-xl mb-4"
                                     style="background:rgba(45,212,255,0.1)">
                                    <x-dynamic-component :component="'lucide-'.$tab['icon']" class="size-6" style="color:var(--hx-blue)" />
                                </div>
                                <h3 class="text-2xl font-semibold tracking-tight">{{ $tab['title'] }}</h3>
                                <p class="hx-text-muted mt-3 leading-relaxed">{{ $tab['desc'] }}</p>
                                <ul class="mt-5 space-y-2.5 text-sm">
                                    @foreach ($tab['points'] as $pt)
                                        <li class="flex items-center gap-2.5">
                                            <span class="inline-flex size-5 items-center justify-center rounded-full shrink-0"
                                                  style="background:rgba(45,212,255,0.1)">
                                                <x-lucide-check class="size-3.5" style="color:var(--hx-blue)" />
                                            </span>
                                            <span style="color:rgba(200,220,245,0.85)">{{ $pt }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="aspect-[4/3] overflow-hidden rounded-xl border" style="border-color:var(--hx-border)">
                                <img src="{{ $tab['img'] }}" alt="{{ $tab['title'] }}" loading="lazy" class="size-full object-cover opacity-80" />
                            </div>
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- ═══ INVESTORS / CTA ═══════════════════════════════════════ --}}
    <section id="investors" class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy)">
        <div class="mx-auto max-w-7xl px-6">
            {{-- Stats row --}}
            <div class="grid grid-cols-2 gap-5 sm:grid-cols-4 mb-14">
                @foreach ($ctaStats as $s)
                    <div class="hx-card p-5 text-center">
                        <div class="hx-mono text-3xl font-bold hx-gradient-text">{{ $s['v'] }}</div>
                        <div class="hx-text-muted text-sm mt-1">{{ $s['l'] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- CTA banner --}}
            <div class="relative overflow-hidden rounded-3xl p-10 text-center lg:p-16"
                 style="background:linear-gradient(135deg,rgba(45,212,255,0.12),rgba(124,92,255,0.15));border:1px solid rgba(124,92,255,0.3);box-shadow:0 0 80px rgba(124,92,255,0.15)">
                <div class="hx-mesh">
                    <div class="hx-blob" style="width:300px;height:300px;background:#7c5cff;top:-100px;left:10%;opacity:0.18"></div>
                    <div class="hx-blob" style="width:250px;height:250px;background:#2dd4ff;top:-80px;right:15%;opacity:0.14"></div>
                </div>
                <div class="relative z-10">
                    <span class="hx-badge hx-badge-violet mb-5 inline-flex">
                        <x-lucide-trending-up class="size-3" /> Investor relations
                    </span>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl text-balance">
                        Join the next chapter of genomic medicine
                    </h2>
                    <p class="hx-text-muted mx-auto mt-4 max-w-xl text-lg text-balance">
                        Backed by {{ implode(', ', array_slice($investors, 0, 3)) }} and others.
                        Request access to our investor data room or speak with our CFO directly.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-3">
                        <a href="#" class="hx-btn-primary inline-flex items-center gap-2 px-6 py-3 text-sm">
                            <x-lucide-file-text class="size-4" /> Request data room
                        </a>
                        <a href="#" class="hx-btn-ghost inline-flex items-center gap-2 px-6 py-3 text-sm">
                            <x-lucide-calendar class="size-4" /> Schedule call
                        </a>
                    </div>
                    {{-- Investor logos --}}
                    <div class="mt-10 flex flex-wrap justify-center gap-3">
                        @foreach ($investors as $inv)
                            <span class="hx-partner-pill">{{ $inv }}</span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══ FAQ ════════════════════════════════════════════════════ --}}
    <section class="hx-section scroll-mt-20 py-20 lg:py-28" style="background:var(--hx-navy2)">
        <div class="mx-auto max-w-3xl px-6">
            <div class="text-center mb-12">
                <span class="hx-badge hx-badge-blue mb-4 inline-flex">
                    <x-lucide-help-circle class="size-3" /> FAQ
                </span>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Frequently asked questions</h2>
            </div>

            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}">
                        <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- ═══ FOOTER ══════════════════════════════════════════════════ --}}
    <footer class="hx-section border-t" style="background:var(--hx-navy);border-color:var(--hx-border)">
        <div class="mx-auto max-w-7xl px-6 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2.5">
                        <span class="flex size-8 items-center justify-center rounded-lg"
                              style="background:linear-gradient(135deg,#2dd4ff,#7c5cff)">
                            <x-lucide-dna class="size-4 text-white" />
                        </span>
                        <span style="font-family:'Space Grotesk',sans-serif;font-weight:700;font-size:1.1rem;color:#f0f6ff">Helix</span>
                    </a>
                    <p class="hx-text-muted mt-3 max-w-xs text-sm leading-relaxed">
                        Engineering biology at the base level — precision genomic medicines for patients who have waited long enough.
                    </p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['twitter', 'linkedin', 'github'] as $soc)
                            <a href="#" aria-label="{{ $soc }}"
                               class="inline-flex size-9 items-center justify-center rounded-md border transition-colors"
                               style="border-color:var(--hx-border);color:rgba(176,200,230,0.6)"
                               onmouseover="this.style.color='#2dd4ff';this.style.borderColor='rgba(45,212,255,0.35)'"
                               onmouseout="this.style.color='rgba(176,200,230,0.6)';this.style.borderColor='var(--hx-border)'">
                                <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Links --}}
                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="text-xs font-semibold tracking-widest uppercase" style="color:var(--hx-blue)">{{ $heading }}</h3>
                        <ul class="mt-4 space-y-2.5 text-sm">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#"
                                       class="hx-text-muted transition-colors"
                                       onmouseover="this.style.color='#f0f6ff'"
                                       onmouseout="this.style.color=''">{{ $link }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" />

            <div class="flex flex-col items-center justify-between gap-3 text-sm sm:flex-row"
                 style="color:rgba(176,200,230,0.5)">
                <span>© {{ date('Y') }} Helix Genomics, Inc. All rights reserved.</span>
                <div class="flex items-center gap-4">
                    <span class="flex items-center gap-1.5">
                        <x-lucide-shield-check class="size-4" style="color:var(--hx-mint)" />
                        FDA IND-track · EMA dialogue
                    </span>
                    <span class="hx-badge hx-badge-grey hx-mono">v2.6.1</span>
                </div>
            </div>
        </div>
    </footer>

</div>{{-- #tpl-helix --}}
</x-layouts.app>

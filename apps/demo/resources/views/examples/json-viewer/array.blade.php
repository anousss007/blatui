{{-- A top-level array of objects, supplied as a JSON string (auto-decoded). --}}
@php
    $json = <<<'JSON'
    [
        { "sku": "BLT-001", "title": "Keyboard", "price": 89.99, "inStock": true },
        { "sku": "BLT-002", "title": "Mouse", "price": 39, "inStock": false },
        { "sku": "BLT-003", "title": "Monitor", "price": 249.5, "inStock": true }
    ]
    JSON;
@endphp

<x-ui.json-viewer :data="$json" root-label="products" class="w-full max-w-md" />

{{-- `copyable` adds a button that copies the hierarchy as a markdown ├──/└──/│ tree. --}}
<x-ui.tree-table
    copyable
    class="max-w-md"
    :columns="[['key' => 'name', 'label' => 'File']]"
    :rows="[
        ['name' => 'my-app', 'expanded' => true, 'children' => [
            ['name' => 'public', 'expanded' => true, 'children' => [
                ['name' => 'favicon.ico'],
                ['name' => 'index.html'],
            ]],
            ['name' => 'src', 'expanded' => true, 'children' => [
                ['name' => 'components', 'expanded' => true, 'children' => [
                    ['name' => 'Button.js'],
                    ['name' => 'Header.js'],
                ]],
                ['name' => 'App.js'],
                ['name' => 'index.js'],
            ]],
            ['name' => '.gitignore'],
            ['name' => 'package.json'],
            ['name' => 'README.md'],
        ]],
    ]"
/>

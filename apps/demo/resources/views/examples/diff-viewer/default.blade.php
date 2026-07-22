{{-- Inline line diff of a small snippet, before to after. --}}
@php
    $before = <<<'TXT'
    function greet(name) {
        return "Hi " + name;
    }
    TXT;

    $after = <<<'TXT'
    function greet(name, greeting = "Hello") {
        return greeting + ", " + name + "!";
    }
    TXT;
@endphp

<x-ui.diff-viewer :old="$before" :new="$after" filename="greet.js" class="w-full max-w-lg" />

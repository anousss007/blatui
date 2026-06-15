{{-- Split (side-by-side) view: original on the left, changed on the right. --}}
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

<x-ui.diff-viewer mode="split" :old="$before" :new="$after" filename="greet.js" class="w-full" />

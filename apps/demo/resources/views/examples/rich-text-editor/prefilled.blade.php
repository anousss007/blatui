@php
    $content = <<<'HTML'
    <h1>Release notes</h1>
    <p>This build ships a few <strong>highlights</strong> worth calling out:</p>
    <ul>
        <li>A brand-new <em>rich text editor</em> component.</li>
        <li>Toolbar formatting with live active-state highlighting.</li>
        <li>The HTML submits via a hidden field, so it just works in forms.</li>
    </ul>
    HTML;
@endphp

<div class="w-full max-w-xl">
    <x-ui.rich-text-editor name="body" :value="$content" />
</div>

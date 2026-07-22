{{-- Seeded with a markdown sample exercising headings, lists, bold, code and a link. --}}
@php
    $sample = <<<'MD'
    # Release notes

    BlatUI **v1.13** ships a brand-new `markdown-editor` component.

    ## Highlights

    - Live HTML *preview* as you type
    - Selection-aware toolbar (bold, italic, code, link)
    - Fully keyboard accessible

    ## Quick start

    ```
    <x-ui.markdown-editor name="content" />
    ```

    > HTML is escaped before rendering, so input is safe.

    Read the [documentation](https://blatui.com/docs) for the full list.
    MD;
@endphp

<div class="w-full max-w-xl">
    <x-ui.markdown-editor name="content" :value="$sample" :rows="12" />
</div>

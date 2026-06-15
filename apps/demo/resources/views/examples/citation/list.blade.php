@php
    $sources = [
        ['title' => 'Attention Is All You Need', 'url' => 'https://arxiv.org/abs/1706.03762'],
        ['title' => 'Language Models are Few-Shot Learners', 'url' => 'https://arxiv.org/abs/2005.14165'],
        ['title' => 'Training language models to follow instructions', 'url' => 'https://arxiv.org/abs/2203.02155'],
    ];
@endphp

<div class="max-w-prose">
    <h3 class="mb-2 text-sm font-semibold text-foreground">Sources</h3>
    <ol class="space-y-2 text-sm">
        @foreach ($sources as $i => $source)
            <li class="flex items-baseline gap-2">
                <x-ui.citation
                    :index="$i + 1"
                    :title="$source['title']"
                    :url="$source['url']"
                />
                <x-ui.link :href="$source['url']" :external="true" class="text-sm">
                    {{ $source['title'] }}
                </x-ui.link>
            </li>
        @endforeach
    </ol>
</div>

@php
    $people = [
        ['src' => 'https://picsum.photos/seed/blatui-a/96', 'name' => 'Ada Lovelace'],
        ['src' => 'https://picsum.photos/seed/blatui-b/96', 'name' => 'Alan Turing'],
        ['src' => 'https://picsum.photos/seed/blatui-c/96', 'name' => 'Grace Hopper'],
        ['name' => 'Linus Torvalds'],
        ['name' => 'Margaret Hamilton'],
    ];
@endphp

<div class="flex flex-col items-start gap-6">
    <x-ui.avatar-group :avatars="$people" :max="4" size="sm" />
    <x-ui.avatar-group :avatars="$people" :max="4" />
    <x-ui.avatar-group :avatars="$people" :max="4" size="lg" />
</div>

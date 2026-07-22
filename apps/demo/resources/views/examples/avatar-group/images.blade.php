@php
    $people = [
        ['src' => 'https://picsum.photos/seed/blatui-a/96', 'name' => 'Ada Lovelace'],
        ['src' => 'https://picsum.photos/seed/blatui-b/96', 'name' => 'Alan Turing'],
        ['src' => 'https://picsum.photos/seed/blatui-c/96', 'name' => 'Grace Hopper'],
        ['src' => 'https://picsum.photos/seed/blatui-d/96', 'name' => 'Linus Torvalds'],
        ['src' => 'https://picsum.photos/seed/blatui-e/96', 'name' => 'Katherine Johnson'],
        ['src' => 'https://picsum.photos/seed/blatui-f/96', 'name' => 'Margaret Hamilton'],
    ];
@endphp

<x-ui.avatar-group :avatars="$people" :max="4" />

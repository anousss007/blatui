@php
    $team = [
        ['name' => 'Ada Lovelace'],
        ['name' => 'Alan Turing'],
        ['name' => 'Grace Hopper'],
        ['name' => 'Linus Torvalds'],
        ['name' => 'Margaret Hamilton'],
    ];
@endphp

<x-ui.avatar-group :avatars="$team" :max="4" />

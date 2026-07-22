{{-- The custom listbox marks the selected option with a trailing check by default.
     Switch to `radio` or `checkbox` — in the compositional API set `indicator` on
     <x-ui.select-content> and it cascades to every item. --}}
<x-ui.select :options="['light' => 'Light', 'dark' => 'Dark', 'system' => 'System']" value="system" indicator="radio" />

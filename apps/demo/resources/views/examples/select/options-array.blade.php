{{-- Shorthand: pass an [value => label] array instead of composing items by hand. --}}
<x-ui.select
    value="banana"
    :options="['apple' => 'Apple', 'banana' => 'Banana', 'cherry' => 'Cherry', 'grape' => 'Grape']"
    placeholder="Pick a fruit"
    class="w-[200px]"
/>

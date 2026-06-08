{{-- native: a BlatUI-styled real <select> — submits without JS, name-bound, validation-
     friendly. Put <option>s in the slot and mark the selected one with `selected`. --}}
<x-ui.select native name="status" class="w-[200px]">
    <option value="" disabled>Select status…</option>
    <option value="active">Active</option>
    <option value="pending" selected>Pending</option>
    <option value="declined">Declined</option>
</x-ui.select>

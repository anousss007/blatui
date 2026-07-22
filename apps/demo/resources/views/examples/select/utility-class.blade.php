{{-- Raw <select> styled by .blat-select — native submit, name-bound, and safe to nest inside
     slots. Prefer this over the x-ui.select native component when the control is re-wrapped by
     another anonymous component's slot. --}}
<select class="blat-select w-full max-w-sm" name="status" aria-label="Status">
    <option value="" disabled selected>Select status…</option>
    <option>Active</option>
    <option>Pending</option>
    <option>Declined</option>
</select>

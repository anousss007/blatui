{{-- For a NATIVE-submit / nested form control, style a raw element with the foundations
     utility instead of a slot component. (Slot components such as x-ui.textarea / x-ui.select
     native can hit a Blade compile error when re-wrapped through another anonymous component's
     slot — a raw element + .blat-* utility sidesteps it entirely.) --}}
<input class="blat-input w-full max-w-sm" type="email" placeholder="you@example.com" />

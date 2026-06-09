{{-- Accepts letters and digits (alphanumeric) instead of digits only. --}}
<x-ui.input-otp :maxlength="6" alphanumeric>
    <x-ui.input-otp-group>
        <x-ui.input-otp-slot :index="0" />
        <x-ui.input-otp-slot :index="1" />
        <x-ui.input-otp-slot :index="2" />
        <x-ui.input-otp-slot :index="3" />
        <x-ui.input-otp-slot :index="4" />
        <x-ui.input-otp-slot :index="5" />
    </x-ui.input-otp-group>
</x-ui.input-otp>

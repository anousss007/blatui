{{-- Two columns per row (name + email). Submits as guests[0][name], guests[0][email], … --}}
<div class="w-full max-w-xl">
    <x-ui.repeater
        name="guests"
        :fields="[
            ['key' => 'name', 'label' => 'Name', 'placeholder' => 'Ada Lovelace'],
            ['key' => 'email', 'label' => 'Email', 'placeholder' => 'ada@example.com', 'type' => 'email'],
        ]"
        :value="[
            ['name' => 'Ada Lovelace', 'email' => 'ada@example.com'],
            ['name' => 'Alan Turing', 'email' => 'alan@example.com'],
        ]"
        add-label="Add guest"
    />
</div>

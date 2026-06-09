{{-- A plain picker: `:searchable="false"` drops the search box. The panel matches the trigger width. --}}
<x-ui.combobox
    :searchable="false"
    placeholder="Select a plan…"
    width="w-[220px]"
    :options="[
        ['value' => 'free', 'label' => 'Free'],
        ['value' => 'pro', 'label' => 'Pro'],
        ['value' => 'team', 'label' => 'Team'],
        ['value' => 'enterprise', 'label' => 'Enterprise'],
    ]"
/>

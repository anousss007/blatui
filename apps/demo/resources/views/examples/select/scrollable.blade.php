<x-ui.select>
    <x-ui.select-trigger class="w-[220px]" aria-label="Select a timezone">
        <x-ui.select-value placeholder="Select a timezone" />
    </x-ui.select-trigger>
    <x-ui.select-content>
        <x-ui.select-group>
            <x-ui.select-label>North America</x-ui.select-label>
            <x-ui.select-item value="est">Eastern Standard Time (EST)</x-ui.select-item>
            <x-ui.select-item value="cst">Central Standard Time (CST)</x-ui.select-item>
            <x-ui.select-item value="mst">Mountain Standard Time (MST)</x-ui.select-item>
            <x-ui.select-item value="pst">Pacific Standard Time (PST)</x-ui.select-item>
        </x-ui.select-group>
        <x-ui.select-group>
            <x-ui.select-label>Europe &amp; Africa</x-ui.select-label>
            <x-ui.select-item value="gmt">Greenwich Mean Time (GMT)</x-ui.select-item>
            <x-ui.select-item value="cet">Central European Time (CET)</x-ui.select-item>
            <x-ui.select-item value="eet">Eastern European Time (EET)</x-ui.select-item>
            <x-ui.select-item value="cat">Central Africa Time (CAT)</x-ui.select-item>
        </x-ui.select-group>
        <x-ui.select-group>
            <x-ui.select-label>Asia</x-ui.select-label>
            <x-ui.select-item value="ist">India Standard Time (IST)</x-ui.select-item>
            <x-ui.select-item value="jst">Japan Standard Time (JST)</x-ui.select-item>
            <x-ui.select-item value="gst">Gulf Standard Time (GST)</x-ui.select-item>
        </x-ui.select-group>
    </x-ui.select-content>
</x-ui.select>

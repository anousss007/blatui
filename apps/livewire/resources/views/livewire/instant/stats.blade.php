<div class="mt-4 grid gap-4 sm:grid-cols-3" data-testid="stats">
    <x-ui.stat label="Total" caption="brands">{{ $this->brandStats['total'] }}</x-ui.stat>
    <x-ui.stat label="Active" caption="brands">{{ $this->brandStats['active'] }}</x-ui.stat>
    <x-ui.stat label="With products" caption="brands">{{ $this->brandStats['products'] }}</x-ui.stat>
</div>

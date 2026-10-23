<div>
    <h1 class="text-2xl font-bold">Controls inside a dialog, under wire:model.live</h1>

    <x-ui.button wire:click="open" class="mt-6" data-testid="open">Checkout</x-ui.button>
    <p class="text-muted-foreground mt-2 text-sm">
        branch: <span data-testid="echo-branch">{{ $pickupBranchId ?? 'none' }}</span> ·
        category: <span data-testid="echo-category">{{ $category ?: 'none' }}</span>
    </p>

    <x-ui.dialog id="checkout" class="contents">
        <x-ui.dialog-content :close-on-overlay="false">
            <x-ui.dialog-header>
                <x-ui.dialog-title>Confirm payment</x-ui.dialog-title>
            </x-ui.dialog-header>

            <x-ui.field-group>
                <x-ui.field>
                    <x-ui.field-label>Delivery</x-ui.field-label>
                    <x-ui.toggle-group type="single" variant="outline" :value="$deliveryMode" wire:model="deliveryMode" aria-label="Delivery">
                        <x-ui.toggle-group-item value="immediate">Store</x-ui.toggle-group-item>
                        <x-ui.toggle-group-item value="pickup">Pickup</x-ui.toggle-group-item>
                    </x-ui.toggle-group>
                </x-ui.field>

                <div x-show="$wire.deliveryMode === 'pickup'" x-cloak>
                    <x-ui.field>
                        <x-ui.field-label for="branch">Pickup branch</x-ui.field-label>
                        <x-ui.select :value="$pickupBranchId" wire:model.live="pickupBranchId" data-testid="branch">
                            <x-ui.select-trigger id="branch" class="w-full">
                                <x-ui.select-value placeholder="Select a branch" />
                            </x-ui.select-trigger>
                            <x-ui.select-content>
                                @foreach ($branches as $id => $name)
                                    <x-ui.select-item :value="(string) $id">{{ $name }}</x-ui.select-item>
                                @endforeach
                            </x-ui.select-content>
                        </x-ui.select>
                    </x-ui.field>

                    @if ($stock)
                        <p wire:key="pickup-availability" data-testid="stock" class="mt-2 text-sm">{{ $stock }}</p>
                    @endif
                </div>

                <x-ui.field>
                    <x-ui.field-label>Category</x-ui.field-label>
                    <x-ui.combobox
                        id="category"
                        wire:model.live="category"
                        :options="$categories"
                        width="w-full"
                        placeholder="Select a category"
                        x-init="window.__comboboxInit = (window.__comboboxInit || 0) + 1"
                        data-testid="category"
                    />
                </x-ui.field>

                <x-ui.field>
                    <x-ui.field-label for="amount">Amount received</x-ui.field-label>
                    <x-ui.number-input id="amount" :min="0" :step="0.01" wire:model="amountReceived" />
                </x-ui.field>

                <x-ui.dropdown-menu>
                    <x-ui.dropdown-menu-trigger>
                        <x-ui.button variant="outline" data-testid="more">More</x-ui.button>
                    </x-ui.dropdown-menu-trigger>
                    <x-ui.dropdown-menu-content>
                        <x-ui.dropdown-menu-item>Print receipt</x-ui.dropdown-menu-item>
                        <x-ui.dropdown-menu-item>Email receipt</x-ui.dropdown-menu-item>
                    </x-ui.dropdown-menu-content>
                </x-ui.dropdown-menu>
            </x-ui.field-group>

            <x-ui.dialog-footer>
                <x-ui.dialog-close data-testid="close">Close</x-ui.dialog-close>
            </x-ui.dialog-footer>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>

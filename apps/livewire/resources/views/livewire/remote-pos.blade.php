<div class="space-y-10">
    <h1 class="text-2xl font-bold">Remote lists (#61)</h1>

    {{-- Part 3: a customer among 87,018. The field and the card are both on the page; Alpine
         decides which one shows, at the moment of the pick. Livewire only receives customerId,
         deferred: it travels with save(). --}}
    <section
        x-data="{
            customer: null,
            creating: false,
            draft: { name: '', document: '' },
            pick(option) {
                this.customer = option;
                $wire.customerId = option.value;
                $wire.walkIn = false;
            },
            walkIn() {
                this.customer = { label: 'Clientes varios', document: null, walkIn: true };
                $wire.customerId = null;
                $wire.walkIn = true;
            },
            async create() {
                this.pick(await $wire.createCustomer(this.draft.name, this.draft.document));
                this.creating = false;
                this.draft = { name: '', document: '' };
            },
        }"
        class="max-w-md space-y-2"
    >
        <h2 class="font-semibold">Customer</h2>

        <div x-show="! customer" data-testid="customer-field">
            <x-ui.combobox
                trigger="input"
                remote
                :page-size="30"
                width="w-full"
                placeholder="Buscar cliente (DNI, RUC o nombre)"
                empty="Cliente no encontrado."
                x-on:combobox-fetch="$event.detail.respond($wire.searchCustomers($event.detail.query, $event.detail.offset, $event.detail.limit))"
                x-on:combobox-select.prevent="pick($event.detail.option)"
            >
                <x-slot:start>
                    <x-lucide-search aria-hidden="true" />
                </x-slot:start>
                <x-slot:end>
                    <x-ui.input-group-button variant="default" size="icon-xs" aria-label="Clientes varios" title="Clientes varios" x-on:click="walkIn()" data-testid="walk-in">
                        <x-lucide-users aria-hidden="true" />
                    </x-ui.input-group-button>
                    <x-ui.input-group-button variant="default" size="icon-xs" aria-label="Nuevo cliente" title="Nuevo cliente" x-on:click="creating = true" data-testid="new-customer">
                        <x-lucide-user-plus aria-hidden="true" />
                    </x-ui.input-group-button>
                </x-slot:end>
            </x-ui.combobox>
        </div>

        <x-ui.item x-show="customer" x-cloak variant="muted" size="sm" data-testid="customer-card">
            <x-ui.item-media variant="icon">
                <x-lucide-user x-show="! customer?.walkIn" aria-hidden="true" />
                <x-lucide-users x-show="customer?.walkIn" aria-hidden="true" />
            </x-ui.item-media>
            <x-ui.item-content>
                <x-ui.item-title x-text="customer?.label" data-testid="customer-name"></x-ui.item-title>
                <x-ui.item-description x-show="customer?.document" x-text="customer?.document"></x-ui.item-description>
            </x-ui.item-content>
            <x-ui.item-actions>
                <x-ui.button type="button" variant="ghost" size="icon-sm" aria-label="Cambiar cliente" title="Cambiar cliente" x-on:click="customer = null; $wire.customerId = null; $wire.walkIn = false" data-testid="change-customer">
                    <x-lucide-x aria-hidden="true" />
                </x-ui.button>
            </x-ui.item-actions>
        </x-ui.item>

        <x-ui.dialog x-model="creating">
            <x-ui.dialog-content>
                <x-ui.dialog-header>
                    <x-ui.dialog-title>Nuevo cliente</x-ui.dialog-title>
                </x-ui.dialog-header>
                <form id="new-customer-form" x-on:submit.prevent="create()" class="space-y-3">
                    <x-ui.input x-model="draft.name" placeholder="Nombre" data-testid="new-name" required />
                    <x-ui.input x-model="draft.document" placeholder="DNI o RUC" data-testid="new-document" required />
                </form>
                <x-ui.dialog-footer>
                    <x-ui.button type="submit" form="new-customer-form" data-testid="new-save">Guardar</x-ui.button>
                </x-ui.dialog-footer>
            </x-ui.dialog-content>
        </x-ui.dialog>
    </section>

    {{-- Part 5: products into a table, one line per product. The pick never stores a value
         (preventDefault): it adds a line, or one more of an existing one, and the field empties
         for the next scan. The lines are $wire.lines itself, so nothing is copied back. --}}
    <section
        x-data="{
            add(option) {
                const line = $wire.lines.find((l) => l.variantId === option.value);
                if (line) {
                    line.quantity = (Number(line.quantity) || 0) + 1;
                    return;
                }
                $wire.lines.push({
                    key: 'v' + option.value,
                    variantId: option.value,
                    sku: option.sku,
                    barcode: option.barcode,
                    productName: option.label,
                    salePrice: option.salePrice,
                    availableStock: option.availableStock,
                    quantity: 1,
                });
            },
        }"
        class="space-y-3"
    >
        <h2 class="font-semibold">Products</h2>

        <x-ui.combobox
            trigger="input"
            remote
            :page-size="30"
            width="w-full max-w-md"
            placeholder="Buscar por nombre, SKU o código"
            empty="Producto no encontrado."
            data-testid="product-search"
            x-on:combobox-fetch="$event.detail.respond($wire.searchProducts($event.detail.query, $event.detail.offset, $event.detail.limit))"
            x-on:combobox-select.prevent="add($event.detail.option)"
        >
            <x-slot:start>
                <x-lucide-search aria-hidden="true" />
            </x-slot:start>
        </x-ui.combobox>

        <div class="overflow-x-auto rounded-lg border">
            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>Código / SKU</x-ui.table-head>
                        <x-ui.table-head>Producto</x-ui.table-head>
                        <x-ui.table-head class="text-end">Precio</x-ui.table-head>
                        <x-ui.table-head class="text-end">Stock</x-ui.table-head>
                        <x-ui.table-head class="w-40 text-end">Cantidad</x-ui.table-head>
                        <x-ui.table-head><span class="sr-only">Acción</span></x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body data-testid="lines">
                    <template x-for="(line, index) in $wire.lines" :key="line.key">
                        <x-ui.table-row x-bind:data-line="line.sku">
                            <x-ui.table-cell>
                                <span class="font-medium" x-text="line.barcode"></span>
                                <span class="text-muted-foreground text-xs" x-text="line.sku"></span>
                            </x-ui.table-cell>
                            <x-ui.table-cell x-text="line.productName"></x-ui.table-cell>
                            <x-ui.table-cell class="text-end tabular-nums" x-text="line.salePrice"></x-ui.table-cell>
                            <x-ui.table-cell class="text-end tabular-nums" x-text="line.availableStock"></x-ui.table-cell>
                            <x-ui.table-cell>
                                <x-ui.number-input
                                    x-bind:data-blat-model="'lines.' + index + '.quantity'"
                                    :value="null"
                                    :min="1"
                                    :step="1"
                                    :decimals="0"
                                    aria-label="Cantidad"
                                    class="w-full"
                                />
                            </x-ui.table-cell>
                            <x-ui.table-cell>
                                <x-ui.button type="button" variant="outline" size="icon" x-on:click="$wire.lines.splice(index, 1)" aria-label="Quitar producto" data-testid="remove-line">
                                    <x-lucide-x aria-hidden="true" />
                                </x-ui.button>
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    </template>
                    <x-ui.table-row x-show="$wire.lines.length === 0">
                        <x-ui.table-cell colspan="6" class="text-muted-foreground text-center">No hay productos agregados.</x-ui.table-cell>
                    </x-ui.table-row>
                </x-ui.table-body>
            </x-ui.table>
        </div>
    </section>

    <div class="space-y-2">
        <x-ui.button wire:click="save" data-testid="save">Guardar</x-ui.button>
        <p data-testid="saved">{{ $saved }}</p>
    </div>
</div>

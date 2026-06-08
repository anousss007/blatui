<x-ui.card variant="sectioned" class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Payment details</x-ui.card-title>
        <x-ui.card-description>Enter your card information to continue.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content>
        <form class="flex flex-col gap-5">
            <x-ui.field>
                <x-ui.field-label for="pay-name">Name on card</x-ui.field-label>
                <x-ui.input id="pay-name" placeholder="Sofia Carter" autocomplete="cc-name" />
            </x-ui.field>
            <x-ui.field>
                <x-ui.field-label for="pay-number">Card number</x-ui.field-label>
                <x-ui.input id="pay-number" inputmode="numeric" placeholder="1234 1234 1234 1234" autocomplete="cc-number" />
            </x-ui.field>
            <div class="grid grid-cols-2 gap-4">
                <x-ui.field>
                    <x-ui.field-label for="pay-exp">Expires</x-ui.field-label>
                    <x-ui.input id="pay-exp" placeholder="MM/YY" autocomplete="cc-exp" />
                </x-ui.field>
                <x-ui.field>
                    <x-ui.field-label for="pay-cvc">CVC</x-ui.field-label>
                    <x-ui.input id="pay-cvc" inputmode="numeric" placeholder="CVC" autocomplete="cc-csc" />
                </x-ui.field>
            </div>
        </form>
    </x-ui.card-content>
    <x-ui.card-footer>
        <x-ui.button class="w-full">Continue</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>

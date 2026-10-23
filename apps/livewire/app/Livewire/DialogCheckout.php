<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * The POS checkout modal from issues #45, #47 and #48, cut down to the parts that matter.
 *
 * Everything sits in an <x-ui.dialog>, whose focus trap used to take the keyboard back from any
 * teleported list (#45). The pickup branch is a typed ?int bound with wire:model.live inside an
 * x-show wrapper, and choosing one re-renders a server block that depends on it: the request that
 * comes back is what used to put the select's placeholder back over a chosen branch (#48). The
 * amount field is named by a visible <label for>, which a fallback aria-label outranked (#47).
 */
class DialogCheckout extends Component
{
    public string $deliveryMode = 'pickup';

    /** Typed, so Livewire sends back an int while the items render value="2". */
    public ?int $pickupBranchId = null;

    public string $category = '';

    public ?string $amountReceived = null;

    public int $renders = 0;

    private const BRANCHES = [1 => 'North', 2 => 'South', 3 => 'East'];

    public function open(): void
    {
        $this->renders++;
        $this->dispatch('open-dialog-checkout');
    }

    public function render()
    {
        $this->renders++;

        return view('livewire.dialog-checkout', [
            'branches' => self::BRANCHES,
            'categories' => [['value' => 'food', 'label' => 'Food'], ['value' => 'drinks', 'label' => 'Drinks']],
            'stock' => $this->pickupBranchId ? self::BRANCHES[$this->pickupBranchId].' has 4 in stock' : null,
        ]);
    }
}

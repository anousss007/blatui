<?php

namespace App\Livewire;

use App\Livewire\Forms\VariantForm;
use Livewire\Component;

/**
 * number-input bound to a Form object's prices. Issue #31.
 *
 * Selecting a price and typing over it passes through an empty field on the way. The component
 * sent that empty field as null the moment it happened; Livewire leaves a non-nullable typed
 * property uninitialized when it receives null, and the next render read it and threw.
 *
 * The profit is computed in the browser from the two bound properties — no request per keystroke,
 * which is the Alpine half of the same report.
 */
class NumberForm extends Component
{
    public VariantForm $variantForm;

    public int $ticks = 0;

    public bool $saved = false;

    public function tick(): void
    {
        $this->ticks++;
    }

    public function save(): void
    {
        $this->variantForm->validate();
        $this->saved = true;
    }

    public function render()
    {
        return view('livewire.number-form');
    }
}

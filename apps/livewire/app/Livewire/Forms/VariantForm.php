<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

/** The Form object from issue #31: prices, at two decimals, some of them never null in PHP. */
class VariantForm extends Form
{
    public float $lastPurchaseCost = 0.0;

    public float $salePrice = 0.0;

    /** The same field for a price that is allowed to be missing — `required` is what rejects it. */
    #[Validate('required|numeric|min:0')]
    public ?float $listPrice = 9.9;
}

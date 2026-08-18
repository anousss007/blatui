<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * The deeper half of the same class of bug: a morph does not only fail to re-run our
 * wiring, it actively undoes it.
 *
 * x-blat-field generates an id for the control and points the label's `for` at it. Those
 * attributes exist only in the DOM — the server's HTML has never heard of them. Livewire's
 * morph syncs attributes against the server's version, so on the next re-render it strips
 * them back off. Nothing in the app changed; a counter ticked somewhere else in the same
 * component, and the field quietly lost its accessible name.
 */
class LabelWiring extends Component
{
    public int $ticks = 0;

    public string $nickname = '';

    public function tick(): void
    {
        $this->ticks++;
    }

    public function render()
    {
        return view('livewire.label-wiring');
    }
}

<?php

namespace App\Livewire;

use Livewire\Component;

/** Issue #19 as reported: the same field, inside <x-ui.dialog>, submitted from the dialog. */
class DialogField extends Component
{
    /** Bound from INSIDE the dialog, whose content Alpine teleports out to <body> (#25). */
    public string $choice = 'b';

    public string $name = '';

    public function save(): void
    {
        $this->validate(['name' => 'required']);
    }

    public function render()
    {
        return view('livewire.dialog-field');
    }
}

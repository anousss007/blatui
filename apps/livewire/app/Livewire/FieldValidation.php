<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * Issue #19, on a plain page.
 *
 * The field renders valid, then a failed submit morphs <x-ui.field-error> into a subtree
 * that already exists. The <div data-slot="field"> is never recreated, so Alpine never
 * re-initialises x-blat-field — which is the whole bug. `clear()` walks it back the other
 * way, because wiring that can be applied and never withdrawn is only half working.
 */
class FieldValidation extends Component
{
    public string $name = '';

    public string $email = '';

    public function save(): void
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);
    }

    /** Make both fields valid and re-render, so the errors morph back OUT. */
    public function clear(): void
    {
        $this->name = 'Ada';
        $this->email = 'ada@example.com';
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.field-validation');
    }
}

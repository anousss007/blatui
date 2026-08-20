<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

/**
 * The same interactive surface as the other pages, but booted by the PUBLISHED blatui.js
 * bootstrap rather than by registering into Livewire's Alpine. See resources/js/greenfield.js.
 */
#[Layout('layouts.greenfield')]
class Greenfield extends Component
{
    public string $name = '';

    public bool $notify = false;

    public function save(): void
    {
        $this->validate(['name' => 'required']);
    }

    public function render()
    {
        return view('livewire.greenfield');
    }
}

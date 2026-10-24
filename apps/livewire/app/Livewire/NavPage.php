<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

/** A page behind the #54 sidebar, which lives in @persist in layouts.nav. */
#[Layout('layouts.nav')]
class NavPage extends Component
{
    public int $page = 0;

    public function mount(int $page = 0): void
    {
        $this->page = $page;
    }

    public function render()
    {
        return view('livewire.nav-page');
    }
}

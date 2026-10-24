<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * #54: a long sidebar in its own Livewire component, the way the reporter's app has it. Links are
 * marked `current` instead of being given isActive, so the sidebar stays right when the page
 * around it changes and it does not: inside @persist, or re-rendered by an update request.
 */
class NavSidebar extends Component
{
    public string $base = '/nav';

    public int $renders = 0;

    public function refresh(): void {}

    public function render()
    {
        $this->renders++;

        return view('livewire.nav-sidebar');
    }
}

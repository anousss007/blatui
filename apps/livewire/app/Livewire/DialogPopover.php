<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * The follow-up half of issue #18, reproduced the way the reporter actually hit it.
 *
 * `open()` mutates state and dispatches the open event in the same request, so Livewire
 * morphs the subtree containing the combobox *while the dialog is still hidden*. The morph
 * replaces the trigger <button>; anything holding that node from init time is now holding a
 * detached element that will never resize or scroll again. Fixed in 1.24.4 by re-resolving
 * the reference — this is the first thing in the repo that can actually run that path.
 */
class DialogPopover extends Component
{
    /** @var array<int, string> */
    public array $branches = [];

    public int $renders = 0;

    public function open(): void
    {
        $this->branches = [];
        $this->renders++;
        $this->dispatch('open-dialog-picker');
    }

    public function render()
    {
        return view('livewire.dialog-popover', [
            'branchOptions' => [
                'antwerp' => 'Antwerp',
                'brussels' => 'Brussels',
                'ghent' => 'Ghent',
                'leuven' => 'Leuven',
            ],
        ]);
    }
}

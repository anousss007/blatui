<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * The wire:model bridge, under a real Livewire runtime.
 *
 * Every value-bearing BlatUI component used to bind through `@entangle`, which keeps a SECOND
 * copy of the value in Alpine and syncs the two with effects. Livewire 4 deprecates the
 * directive, and the shape of it was wrong in three ways at once: two sources of truth, a
 * component id baked into an x-data that Alpine evaluates exactly once, and a sync that is
 * never released when the element leaves the DOM. Issue #22.
 *
 * The replacement ($blatModel, in blatui-core.js) has no second copy: it reads and writes the
 * Livewire property itself, resolving both the property path and the owning component out of
 * the DOM on every access. That is only provable here — apps/demo has no Livewire runtime, so
 * the entire wired branch of every one of these components renders there and never runs.
 *
 * The file half is issue #23: the per-file progress bar was a setInterval animating to 100% in
 * about a second, unconnected to the upload. Now it is Livewire's own upload progress.
 */
class WireModel extends Component
{
    use WithFileUploads;

    public ?float $amount = null;      // number-input, deferred

    public ?float $live = 0;           // number-input, wire:model.live

    public bool $agreed = false;       // checkbox

    public array $tags = [];           // tags-input

    public string $plan = '';          // select

    public int $ticks = 0;

    public $upload;

    /** Assign from the server, to prove the components follow the property back. */
    public function seed(): void
    {
        $this->amount = 12.5;
        $this->agreed = true;
        $this->tags = ['alpha', 'beta'];
        $this->plan = 'Pro';
    }

    public function tick(): void
    {
        $this->ticks++;
    }

    public function render()
    {
        return view('livewire.wire-model');
    }
}

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
 * The range half is issue #24: mode="range" rendered its from/to form fields and nothing else,
 * so the one mode a Livewire date filter actually wants could not be bound at all.
 *
 * The file half is issue #23: the per-file progress bar was a setInterval animating to 100% in
 * about a second, unconnected to the upload. Now it is Livewire's own upload progress.
 *
 * The file half again, as issue #29: since the component survives the morph (#27) rather than
 * being replaced by it, its list survives too — including across a reset. A modal reused to
 * create a second record came up showing the first record's thumbnail, with the property back to
 * null on the server. clearUpload() below is that reset, and the component now follows it.
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

    public array $stay = ['from' => '', 'to' => ''];   // date-picker, mode=range

    public array $price = [20, 80];                    // slider, range

    public $upload;

    /** The reset a form does after saving — the property the field is bound to goes back to null. */
    public function clearUpload(): void
    {
        $this->upload = null;
    }

    public string $story = '';           // rich-text-editor, deferred

    /** Assign from the server, to prove the components follow the property back. */
    public function seed(): void
    {
        $this->amount = 12.5;
        $this->agreed = true;
        $this->tags = ['alpha', 'beta'];
        $this->plan = 'Pro';
        $this->stay = ['from' => '2026-03-12', 'to' => '2026-03-16'];
        $this->price = [40, 60];
        $this->story = '<p>from the server</p>';
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

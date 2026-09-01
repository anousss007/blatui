<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * Components that used to name their own elements, under a real re-render.
 *
 * Livewire's morph keys an element by wire:id, then wire:key, then its plain id. Every one of
 * the components below generated that id with Str::random, so the old and the new element read
 * as different elements and morphdom replaced the node instead of patching it — on every
 * re-render, forever. It cost real state: the text being typed into rich-text-editor and
 * mention-input, the caret and focus everywhere else, and in file-upload (on /wire-model) an
 * upload that finished server-side but never said so. Issue #27.
 *
 * There is no user action here beyond tick(): the point is that a re-render the user did not
 * cause, of a component they are in the middle of using, leaves everything where it was.
 */
class GeneratedIds extends Component
{
    public int $ticks = 0;

    public function tick(): void
    {
        $this->ticks++;
    }

    public function render()
    {
        return view('livewire.generated-ids');
    }
}

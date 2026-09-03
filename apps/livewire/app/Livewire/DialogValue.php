<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

/**
 * file-upload's :value inside a dialog that is reused for every record. Issue #30.
 *
 * <x-ui.dialog> teleports its content to <body> and shows it — it never unmounts, so it is the
 * same Alpine component on the second open as on the first. Nothing in it is re-evaluated when
 * the server sends a different record's file, and the bound upload property cannot stand in as
 * the trigger: on an edit form it is null before the dialog opens and null after, so an effect
 * subscribed to it never re-runs. The field showed the previous record's logo, or nothing at all
 * on the first open, while data-blat-value on the root already carried the right URL.
 *
 * Data URIs rather than files: this page asserts there are no console errors, and a 404 on a
 * thumbnail is one.
 */
class DialogValue extends Component
{
    use WithFileUploads;

    /** The consumer's upload property. Always null here — that is the whole point. */
    public $logo;

    public ?string $recordId = null;

    /** Unrelated to the logo, and bound live: a commit that must not be what fixes the preview. */
    public bool $active = false;

    private const RECORDS = [
        'a' => 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'8\' height=\'8\'%3E%3C/svg%3E#a',
        'b' => 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'8\' height=\'8\'%3E%3C/svg%3E#b',
    ];

    /** Open the dialog for a record, exactly as the report does: assign, then dispatch. */
    public function edit(string $id): void
    {
        $this->recordId = $id;
        $this->logo = null;
        $this->dispatch('open-dialog-record');
    }

    public function logoUrl(): ?string
    {
        return $this->recordId ? self::RECORDS[$this->recordId] : null;
    }

    public function logoName(): ?string
    {
        return $this->recordId ? "logo-{$this->recordId}.svg" : null;
    }

    public function render()
    {
        return view('livewire.dialog-value');
    }
}

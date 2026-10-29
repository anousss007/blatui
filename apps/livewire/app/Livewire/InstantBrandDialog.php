<?php

namespace App\Livewire;

use Livewire\Attributes\Locked;
use Livewire\Component;

/**
 * #59: the create/edit dialog, built the way we recommend. The parent only dispatches browser
 * events; this component opens its own dialog through `$wire.open` (wire:model on the dialog,
 * no request), resets when the dialog closes rather than when it opens, and loads a record with
 * a direct `$wire.edit()` call so wire:loading can target it. Both server calls sleep, so the
 * browser suite can tell a dialog that waited from one that did not.
 */
class InstantBrandDialog extends Component
{
    public const LATENCY_US = 300_000;

    public bool $open = false;

    #[Locked]
    public ?int $brandId = null;

    public string $name = '';

    public string $description = '';

    public bool $active = true;

    public function edit(int $id): void
    {
        usleep(self::LATENCY_US);
        $brand = InstantBrands::brandList()[$id];
        $this->brandId = $id;
        $this->name = $brand['name'];
        $this->description = $brand['description'];
        $this->active = $brand['active'];
    }

    public function save(): void
    {
        usleep(self::LATENCY_US);
        $this->validate(['name' => 'required|max:100', 'description' => 'max:1000']);
        $id = $this->brandId ?? max(array_keys(InstantBrands::brandList())) + 1;
        InstantBrands::put(['id' => $id, 'name' => $this->name, 'description' => $this->description, 'active' => $this->active, 'products_count' => 0]);

        // Closing is enough: wire:dialog-closed resets the form once the fade-out is over.
        $this->open = false;
        $this->dispatch('saved');
    }

    public function resetForm(): void
    {
        $this->reset('brandId', 'name', 'description', 'active');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.instant.brand-dialog');
    }
}

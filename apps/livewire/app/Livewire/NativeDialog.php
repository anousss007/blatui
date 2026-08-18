<?php

namespace App\Livewire;

use Livewire\Component;

/**
 * x-blat-dialog-layer, which is the only wiring in the engine with no other coverage.
 *
 * It moves a teleported popover into the enclosing native <dialog> so the popover shares the
 * browser's top layer instead of painting behind the modal — the FluxUI half of issue #5. A
 * native <dialog> is precisely what BlatUI's own dialog is not (that one is a plain <div>), so
 * nothing in apps/demo can exercise this path.
 *
 * Deliberately NOT asserted across a morph, and the modal is opened client-side rather than
 * through Livewire. Both are the same reason: re-rendering this subtree closes the modal (a
 * native dialog's openness is element state no server-rendered attribute carries) and a morph
 * that lands on the popover's <template x-teleport> leaves it without a panel at all. Those are
 * the app's problems to solve — wire:ignore, or re-showing on render — and scaffolding around
 * them would have the check asserting my workaround rather than the component. What this page
 * is for is the top-layer placement, which nothing else in the repo covers. The directive was
 * measured working here and needed none of the keepWired changes; see blatui-core.js.
 */
class NativeDialog extends Component
{
    public string $plan = 'free';

    public function render()
    {
        return view('livewire.native-dialog');
    }
}

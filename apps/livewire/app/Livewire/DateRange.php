<?php

namespace App\Livewire;

use Livewire\Attributes\Url;
use Livewire\Component;

/**
 * The dashboard from issues #52 and #53: a range picker bound with `:value` and
 * `wire:model.live`, kept in the query string, and a server value derived from it.
 *
 * `:value` used to be written into the picker's x-data, so the first day of a range changed
 * the expression and Alpine re-applied it to the live component: `open` went back to false and
 * the popover closed before the second day could be picked. The other bound components here
 * carried the same expression, and are checked for it across the same round trip.
 */
class DateRange extends Component
{
    #[Url]
    public array $dateRange = ['from' => '', 'to' => ''];

    public string $spanish = '';

    public array $tags = ['alpha'];

    public string $view = 'day';

    public int $renders = 0;

    public function endsToday(): void
    {
        $this->dateRange = ['from' => now()->subDays(3)->toDateString(), 'to' => now()->toDateString()];
    }

    public function render()
    {
        $this->renders++;

        return view('livewire.date-range');
    }
}

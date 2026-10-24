<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;

/** The same pages with the sidebar re-rendered on every visit: no @persist. */
#[Layout('layouts.nav-plain')]
class NavPlainPage extends NavPage {}

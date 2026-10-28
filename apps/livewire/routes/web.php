<?php

use App\Livewire\DataTable;
use App\Livewire\DateRange;
use App\Livewire\DialogCheckout;
use App\Livewire\DialogField;
use App\Livewire\DialogPopover;
use App\Livewire\DialogValue;
use App\Livewire\FieldValidation;
use App\Livewire\GeneratedIds;
use App\Livewire\InstantBrands;
use App\Livewire\Greenfield;
use App\Livewire\LabelWiring;
use App\Livewire\NativeDialog;
use App\Livewire\NavPage;
use App\Livewire\NavPlainPage;
use App\Livewire\NumberForm;
use App\Livewire\TreeTable;
use App\Livewire\WireModel;
use Illuminate\Support\Facades\Route;

/*
 * One route per morph scenario, each named after the wiring it puts under a real Livewire
 * re-render. The browser suite drives these by path, so the names are load-bearing.
 */
Route::get('/', fn () => redirect('/field'));
Route::get('/field', FieldValidation::class);
Route::get('/dialog-checkout', DialogCheckout::class);
Route::get('/dialog-field', DialogField::class);
Route::get('/dialog-popover', DialogPopover::class);
Route::get('/dialog-value', DialogValue::class);
Route::get('/label-wiring', LabelWiring::class);
Route::get('/native-dialog', NativeDialog::class);
Route::get('/data-table', DataTable::class);
Route::get('/date-range', DateRange::class);
Route::get('/greenfield', Greenfield::class);
Route::get('/generated-ids', GeneratedIds::class);
Route::get('/wire-model', WireModel::class);
Route::get('/number-form', NumberForm::class);
Route::get('/tree-table', TreeTable::class);
Route::get('/nav/{page?}', NavPage::class);
Route::get('/nav-plain/{page?}', NavPlainPage::class);
Route::get('/instant', InstantBrands::class);

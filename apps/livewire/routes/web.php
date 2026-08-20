<?php

use App\Livewire\DataTable;
use App\Livewire\DialogField;
use App\Livewire\DialogPopover;
use App\Livewire\FieldValidation;
use App\Livewire\LabelWiring;
use App\Livewire\NativeDialog;
use Illuminate\Support\Facades\Route;

/*
 * One route per morph scenario, each named after the wiring it puts under a real Livewire
 * re-render. The browser suite drives these by path, so the names are load-bearing.
 */
Route::get('/', fn () => redirect('/field'));
Route::get('/field', FieldValidation::class);
Route::get('/dialog-field', DialogField::class);
Route::get('/dialog-popover', DialogPopover::class);
Route::get('/label-wiring', LabelWiring::class);
Route::get('/native-dialog', NativeDialog::class);
Route::get('/data-table', DataTable::class);

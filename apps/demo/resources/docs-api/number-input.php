<?php

// API metadata for the number-input component. Rendered by resources/views/components/docs/api.blade.php.

return [
    'props' => [
        [
            'name' => 'name',
            'type' => 'string',
            'description' => 'Name of the underlying input, used for form submission and as the fallback accessible label.',
        ],
        [
            'name' => 'value',
            'type' => 'number',
            'default' => '0',
            'description' => 'Initial numeric value. Pass null or an empty string to start the field empty.',
        ],
        [
            'name' => 'min',
            'type' => 'number',
            'description' => 'Lowest allowed value. Clamps on blur and disables the decrease button at the floor.',
        ],
        [
            'name' => 'max',
            'type' => 'number',
            'description' => 'Highest allowed value. Clamps on blur and disables the increase button at the ceiling.',
        ],
        [
            'name' => 'step',
            'type' => 'number',
            'default' => '1',
            'description' => 'Amount each increase/decrease button adds or subtracts.',
        ],
        [
            'name' => 'decimals',
            'type' => 'int',
            'description' => 'Fixed decimal places. The field shows the value at this precision (1.90, not 1.9) and rounds what it sends. The bound value stays a number, so trailing zeroes are presentation only.',
        ],
        [
            'name' => 'nullable',
            'type' => 'bool',
            'default' => 'true',
            'description' => 'Whether an emptied field is committed as null on blur. Pass false for a field backed by a non-nullable property: the field then reverts to its previous value. Either way nothing is sent while the field is empty mid-edit.',
        ],
        [
            'name' => 'size',
            'type' => 'string',
            'default' => "'default'",
            'options' => ['sm', 'default', 'lg'],
            'description' => 'Control height and text size; matches the input component so fields line up in a form.',
        ],
        [
            'name' => 'disabled',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Disables the field and both stepper buttons.',
        ],
        [
            'name' => 'id',
            'type' => 'string',
            'description' => 'id attribute of the underlying input, for associating an external label.',
        ],
        [
            'name' => 'placeholder',
            'type' => 'string',
            'description' => 'Placeholder shown while the field is empty.',
        ],
        [
            'name' => 'mask',
            'type' => 'bool',
            'default' => 'false',
            'description' => 'Cents-style currency mask: digits enter from the right at `decimals` places (2 when unset), so typing 190 shows 1.90 and Backspace drops the last digit. Pasted text with a dot or comma is read as a normal number (1.9 stays 1.90). The bound value is written on every keystroke, client side, so a `$watch` on a plain `wire:model` sees each digit. A digit that would pass `max` is refused; `min`, `nullable` and the stepper buttons behave as without the mask.',
        ],
    ],
    'events' => [
        [
            'name' => 'number-change',
            'direction' => 'out',
            'detail' => '{ value }',
            'description' => 'The user changed the value: a keystroke that produced a number, a paste, a stepper click, or the commit on blur (value may then be null). A value written from outside, by the server or by another field, never fires it. That is what makes two fields derived from each other (a price with and without tax) safe: derive the other field in this handler and it cannot echo back.',
        ],
    ],
];

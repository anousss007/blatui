<?php

if (! function_exists('cn')) {
    /**
     * Conditionally join Tailwind classes and resolve conflicts (shadcn `cn`).
     * Accepts strings, arrays (['class' => bool]) — mirrors clsx + tailwind-merge.
     */
    function cn(...$args): string
    {
        $classes = [];

        foreach ($args as $arg) {
            if (is_array($arg)) {
                foreach ($arg as $key => $value) {
                    if (is_int($key)) {
                        $classes[] = $value;
                    } elseif ($value) {
                        $classes[] = $key;
                    }
                }
            } elseif (! empty($arg)) {
                $classes[] = $arg;
            }
        }

        return twMerge(implode(' ', $classes));
    }
}

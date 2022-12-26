<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotSequentialRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $haystack = strtolower($value);
        $group = [];

        for ($start = 48; $start <= 88; $start++) {
            $sequence = '';
            for ($charCode = $start; $charCode < $start + 3; $charCode++) {
                if ($charCode >= 58 && $charCode <= 64) {
                    continue 2;
                }
                $sequence .= chr($charCode);
            }
            $group[] = strtolower($sequence);
        }
        $group[] = '098';

        foreach ($group as $needle) {
            if (strpos($haystack, $needle) !== false || strpos($haystack, strrev($needle)) !== false) {
                return false;
            }
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The password must not contain any sequential letters or numbers.';
    }
}

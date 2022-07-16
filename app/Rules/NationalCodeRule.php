<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NationalCodeRule implements Rule
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
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        // checking that national code must be 10 digits is done in request validation with 'digits:10'
        $arrCode = str_split($value);
        if (count(array_unique($arrCode)) == 1) {
            return false;
        }
        $a = $arrCode[9];
        $b = 0;
        for ($i = 0; $i < 9; $i++) {
            $b += $arrCode[$i] * (10 - $i);
        }
        $c = $b % 11;
        if ($a == $c && $a < 2 || $a == 11 - $c) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        if (config('app.locale') == 'fa') {
            return ':attribute باید 10 رقم و معتبر باشد.';
        } else {
            return ':attribute must be must be 10 digits and valid.';
        }

    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class DateRule implements Rule
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
        $value = substr($value, 0, 6);
        $timestamp = substr(now()->getTimestamp(), 0, 6);
        return $value >= $timestamp;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        if (config('app.locale') == 'fa') {
            return ':attribute باید برابر با زمان حال یا بیشتر از آن باشد.';
        } else {
            return ':attribute must be greater or equal to now.';
        }
    }
}

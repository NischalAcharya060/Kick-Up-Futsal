<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NotInPast implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return strtotime($value) >= strtotime(date('Y-m-d'));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be today or a future date.';
    }
}

<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PakistaniPhoneNumber implements Rule
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
        // Define the regex pattern for Pakistani phone numbers
        $pattern = '/^(?:\+92|92|0)?3[0-9]{9}$/';

        // Validate the phone number against the pattern
        return preg_match($pattern, $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be a valid Pakistani phone number.';
    }
}

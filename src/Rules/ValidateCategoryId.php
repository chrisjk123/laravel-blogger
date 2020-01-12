<?php

namespace Chriscreates\Blog\Rules;

use Chriscreates\Blog\Category;
use Illuminate\Contracts\Validation\Rule;

class ValidateCategoryId implements Rule
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
        return Category::where('id', $value)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The category selected is invalid or does not exist.';
    }
}

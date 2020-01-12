<?php

namespace Chriscreates\Blog\Rules;

use Chriscreates\Blog\Tag;
use Illuminate\Contracts\Validation\Rule;

class ValidateTagIds implements Rule
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
        foreach ($value as $tag_id) {
            if ( ! Tag::where('id', $tag_id)->exists()) {
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
        return 'The tag(s) selected is invalid or does not exist.';
    }
}

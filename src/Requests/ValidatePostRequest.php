<?php

namespace Chriscreates\Blog\Requests;

use Chriscreates\Blog\Rules\ValidateCategoryId;
use Chriscreates\Blog\Rules\ValidateTagIds;
use Illuminate\Foundation\Http\FormRequest;

class ValidatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['nullable', new ValidateCategoryId],
            'user_id' => 'nullable',
            'tags' => ['nullable', new ValidateTagIds],
            'title' => 'required|string|max:150',
            'sub_title' => 'nullable|string',
            'slug' => 'nullable|string',
            'excerpt' => 'nullable|string',
            'content' => 'nullable',
            'allow_comments' => 'nullable|boolean',
            'allow_guest_comments' => 'nullable|boolean',
            'status' => 'nullable',
            'published_at' => 'string|nullable',
        ];
    }
}

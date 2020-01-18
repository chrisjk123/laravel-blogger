<?php

namespace Chriscreates\Blog\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:150',
            'slug' => 'nullable|string',
            'parent_id' => 'nullable',
        ];
    }
}

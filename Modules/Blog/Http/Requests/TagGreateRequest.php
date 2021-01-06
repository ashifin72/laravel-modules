<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagGreateRequest extends FormRequest
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
            'title_ru' => 'nullable|min:3|max:200|unique:tags',
            'title_uk' => 'required|min:3|max:200|unique:tags',
            'slug' => 'max:200|unique:tags',

        ];
    }
}

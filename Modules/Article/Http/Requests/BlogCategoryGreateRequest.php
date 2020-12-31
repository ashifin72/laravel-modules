<?php

namespace Modules\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogCategoryGreateRequest extends FormRequest
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
            'title_ru' => 'required|min:5|max:200',
            'title_uk' => 'required|min:5|max:200',
            'slug' => 'max:200|unique:blog_categories',
            'icon '=> 'string|max:100|min:3',
            'description_ru' => 'string|max:500|min:3',
            'description_uk' => 'string|max:500|min:3',
            'parent_id'=> 'required|integer|exists:blog_categories,id',

        ];
    }
}

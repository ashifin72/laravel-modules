<?php

namespace Modules\Article\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class BlogCategoryUpdateRequest extends FormRequest
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
        $id = $_POST['id'];
        return [
            'title_ru' => 'required|min:5|max:200',
            'title_uk' => 'required|min:5|max:200',
            'icon '=> 'max:100|min:3',
            'description_ru' => 'string|max:500|min:3',
            'description_uk' => 'string|max:500|min:3',
            'parent_id'=> 'required|integer|exists:categories,id',

            'slug' => [
                'max:200',
                Rule::unique('categories')->ignore($id),
            ],
        ];
    }
}

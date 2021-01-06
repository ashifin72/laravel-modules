<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest
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
            'title_ru' => [
                'required',
                'min: 2',
                'max: 200',
                'unique:tags,id,:id'
            ],
            'title_uk' => [
                'required',
                'min: 2',
                'max: 200',
                'unique:tags,id,:id'
            ],
//            'slug' => 'required|max:200',

        ];
    }
}

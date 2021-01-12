<?php

  namespace Modules\Section\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SectionItemRequest extends FormRequest
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
            'title_ru' => 'required|string|min:3|max:200',
            'content_ru' => 'nullable|string|min:3|max:5000',
            'title_uk' => 'required|string|min:3|max:200',
            'content_uk' => 'nullable|string|min:3|max:5000',
            'img' => 'nullable|string|min:3|max:200',
            'sort' => 'required|integer',
            'description_uk' => 'nullable|string|min:3|max:200',
            'description_en' => 'nullable|string|min:3|max:200',
            'description_ru' => 'nullable|string|min:3|max:200',
            'path' => 'nullable|string|max:200',
            'icon' => 'nullable|string|min:3|max:200',
        ];
    }

}

<?php

namespace Modules\Portfolio\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PortfolioCategoryGreateRequest extends FormRequest
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
            'description_ru' => 'required|string|min:3|max:5000',
            'title_uk' => 'required|string|min:3|max:200',
            'description_uk' => 'required|string|min:3|max:5000',
            'slug' => 'max:200|unique:portfolio_categories',
            'img' => 'required|string|min:3|max:200',
            'sort' => 'required|integer',
        ];
    }
}

<?php

namespace Modules\Portfolio\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PorfolioRequest extends FormRequest
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
            'title_ru' => 'required|string|min:3|max:200',
            'description_ru' => 'required|string|min:3|max:300',
            'customer_ru' => 'required|string|min:3|max:100',
            'content_ru' => 'required|string|min:3|max:5000',
            'title_uk' => 'required|string|min:3|max:200',
            'description_uk' => 'required|string|min:3|max:300',
            'customer_uk' => 'required|string|min:3|max:100',
            'content_uk' => 'required|string|min:3|max:5000',
            'slug' => [
                'max:200',
                Rule::unique('portfolios')->ignore($id),
            ],
            'img' => 'required|string|min:3|max:200',
            'sort' => 'required|integer',
            'portfolio_categories_id' => 'required|integer',
            'portfolio_feedback_id' => 'nullable|integer',
            'time_site' => 'nullable|integer',
            'url_site' => 'nullable|string',
            'cms_site' => 'nullable|string',
            'type_site' => 'nullable|string',
        ];
    }
}

<?php

namespace Modules\Menu\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemRequest extends FormRequest
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
            'menu_id' => 'required|integer|exists:menus,id',
            'title_ru' => 'required|string|min:3|max:200',
            'title_uk' => 'required|string|min:3|max:200',
            'path' => 'required|string|min:1|max:200',
            'sort' => 'required|integer|min:1|max:10',

        ];
    }
}

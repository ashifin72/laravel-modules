<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LocalUpdateRequest extends FormRequest
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
            'local' => [
                'required',
                'string',
                'max:3',
                \Illuminate\Validation\Rule::unique('locales')->ignore($_POST['id']),
            ],
            'name' => 'required|min:3|max:200|string',
            'sort' => 'required|integer',
        ];
    }
}

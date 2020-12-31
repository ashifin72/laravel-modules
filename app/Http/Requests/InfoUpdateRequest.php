<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InfoUpdateRequest extends FormRequest
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
            'title_ru' => 'required|min:3|max:50|string',
            'title_uk' => 'required|min:3|max:50|string',
            'img' => 'required|min:3|max:50|string',
            'img_head' => 'nullable|min:3|max:50|string',
            'img_footer' => 'required|min:3|max:50|string',
            'description_ru' => 'required|string|min:8|max:400',
            'description_uk' => 'required|string|min:8|max:400',
            'operating_time_ru' => 'required|string|min:8|max:400',
            'operating_time_uk' => 'required|string|min:8|max:400',
            'slogan_ru' => 'required|string|min:8|max:400',
            'slogan_uk' => 'required|string|min:8|max:400',
            'data_phone1' => 'required|string|min:8',
            'data_phone2' => 'nullable|min:8',
            'data_phone3' => 'nullable|min:8',
            'head_code' => 'nullable|min:8',
            'footer_code' => 'nullable|min:8',
            'instagram' => 'nullable|active_url',
            'facebook' => 'nullable|active_url',
            'youtube' => 'nullable|active_url',
            'data_email' => 'required|email',
        ];
    }
}

<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogPostCreateRequest extends FormRequest
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
            'title_ru' => "nullable|min:5|max:200|unique:posts",
            'title_uk' => 'required|min:5|max:200|unique:posts',
            'slug' => 'nullable|string|max:200|unique:posts',
            'description_uk'=> 'nullable|string|max:250',
            'description_ru'=> 'nullable|string|max:250',
            'content_uk' => 'required|string|max:15000|min:3',
            'content_ru' => 'nullable|string|max:15000|min:3',
            'category_id'=> 'required|integer|exists:categories,id',
            'user_id'=> 'required|integer|exists:users,id',
            'img' => 'nullable|image|max:200',
            'title_soc'=> 'nullable|string|min:8',
            'youtube'=> 'nullable|string|min:8',
            'video'=> 'nullable|string|min:8',
            'github'=> 'nullable|string|min:8',
            'file_sharing'=> 'nullable|string|min:8',
            'keywords'=> 'nullable|string|min:8',
            'soc_description'=> 'nullable|string|min:8',
        ];
    }

}

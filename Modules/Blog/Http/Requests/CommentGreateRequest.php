<?php

namespace Modules\Blog\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentGreateRequest extends FormRequest
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
            'name' => 'required|min:3|max:100',
            'text' => 'required|min:3|max:1000',
            'parent_id' => 'nullable|exists:comments,id',
            'blog_post_id' => 'required|integer|exists:posts,id',
            'email' => 'required|email',
        ];
    }
}

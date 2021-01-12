<?php

  namespace Modules\Section\Http\Requests;

  use Illuminate\Foundation\Http\FormRequest;
  use Illuminate\Validation\Rule;

  class SectionRequest extends FormRequest
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
      $id = $_POST['id'] ?? null;
      return [
        'title_ru' => "required|string|min:3|max:200||unique:sections,title_ru,$id",
        'description_ru' => 'nullable|string|min:3|max:5000',
        'title_uk' => "required|string|min:3|max:200||unique:sections,title_uk,$id",
        'description_uk' => 'nullable|string|min:3|max:5000',
        'slogan_ru' => 'nullable|string|min:3|max:300',
        'slogan_uk' => 'nullable|string|min:3|max:300',
        'img' => 'nullable|string|min:3|max:200',
        'sort' => 'required|integer',
      ];
    }
  }

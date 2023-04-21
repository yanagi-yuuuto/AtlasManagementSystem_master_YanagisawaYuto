<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryFormRequest extends FormRequest
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
            'main_category_name' => 'required|max:100|string|unique:main_categories,main_category',
        ];
    }

    public function messages(){
        return [
            'main_category_name.max' => '100字以内で入力してください。',
            'main_category_name.unique' => 'すでに登録されている名前は使用できません。',
            'main_category_name.required' => '入力必須です。',
        ];
    }

}

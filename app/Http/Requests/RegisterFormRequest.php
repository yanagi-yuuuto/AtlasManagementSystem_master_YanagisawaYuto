<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterFormRequest extends FormRequest
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

    public function getValidatorInstance()
    {
        // プルダウンで選択された値(= 配列)を取得
        $old_year = $this->input('old_year', '');
        $old_month = $this->input('old_month', '');
        $old_day = $this->input('old_day', '');
        //デフォルト値は空の配列


        // 日付を作成(ex. 2020-1-20)
        $birthday_validation = implode('-', [$old_year, $old_month, $old_day]);

        // rules()に渡す値を追加でセット
        //     これで、この場で作った変数にもバリデーションを設定できるようになる
        $this->merge([
            'birth_day' => $birthday_validation,
        ]);

        return parent::getValidatorInstance();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'over_name' => 'required|string|max:10',
                'under_name' => 'required|string|max:10',
                'over_name_kana' => 'required|string|max:30|regex:/^[ァ-ヶー]+$/u',
                'under_name_kana' => 'required|string|max:30|regex:/^[ァ-ヶー]+$/u',
                'mail_address' => 'required|email|unique:users|max:100',
                'sex' => 'required|numeric',
                'birth_day' =>'required|after_or_equal:2000-01-01',
                'role' => 'required|numeric',
                'password' =>'required|min:8|max:30|confirmed'
        ];
    }

    /**
     *  バリデーション項目名定義
     * @return array
     */
    public function attributes()
    {
        return [
                'over_name' => '姓',
                'under_name' => '名',
                'over_name_kana' => 'セイ',
                'under_name_kana' => 'メイ',
                'mail_address' => 'メールアドレス',
                'birth_day' => '生年月日',
                'password' =>'パスワード'
        ];
    }

    /**
     * バリデーションメッセージ
     * @return array
     */
    public function messages()
    {
        return [
                'over_name.required' => '※:attributeを入力して下さい。',
                'under_name.required' => '※:attributeを入力して下さい。',
                'over_name_kana.regex' => '※:attributeはカタカナで入力して下さい。',
                'under_name_kana.regex' => '※:attributeはカタカナで入力して下さい。',
                'mail_address.email' => '※:attributeを正しい形式で入力してください。',
                'mail_address.unique' => '※既に登録されているものは使用できません。',
                'sex.required' => '※選択必須です。',
                'role.required' => '※選択必須です。',
                'birth_day.after_or_equal' => '※:attributeは2000年1月1日以降で入力してください。',
                'birth_day.required' => '※:attributeは入力必須です。',
                'password.min' =>'※:attributeは8文字以上で入力してください。',
                'password.max' =>'※:attributeは30文字以内で入力してください。',
                'password.confirmed' => '※:attributeが一致しません。'
        ];
    }

}

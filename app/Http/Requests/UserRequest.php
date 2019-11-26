<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            // 'email' => 'required|max:250',
            
            'name' => 'required|max:50',
            'age' => 'required',
            'sex' => 'required',
            'location' => 'required',
            'theme' => 'required',
            'receive_email' => 'required',
        ];
    }
    public function messages() {
        return [
        "required" => "必須項目です。",
        "name.max" => "50文字以内で入力してください。",
        "unique" => "メールアドレスはすでにしています"
        ];
    }
}

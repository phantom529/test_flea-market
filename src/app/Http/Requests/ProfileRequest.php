<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'username'      => 'required|string|max:20',
            'postal_code'   => ['required', 'regex:/^\d{3}-\d{4}$/'],
            'address'       => 'required|string|max:255',
            'building'      => 'nullable|string|max:255',
            'profile_image' => 'nullable|image|mimes:jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'username.required'     => 'ユーザー名を入力してください',
            'username.max'          => 'ユーザー名は20文字以内で入力してください',
            'postal_code.required'  => '郵便番号を入力してください',
            'postal_code.regex'     => '郵便番号はハイフンありの8文字で入力してください',
            'address.required'      => '住所を入力してください',
            'profile_image.mimes'   => 'プロフィール画像はjpegまたはpng形式でアップロードしてください',
        ];
    }
}

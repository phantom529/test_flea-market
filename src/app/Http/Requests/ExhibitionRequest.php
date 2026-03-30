<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'          => 'required|string|max:255',
            'description'   => 'required|string|max:255',
            'product_image' => 'required|image|mimes:jpeg,png',
            'categories'    => 'required|array',
            'condition'     => 'required|string',
            'price'         => 'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required'          => '商品名を入力してください',
            'description.required'   => '商品説明を入力してください',
            'description.max'        => '商品説明は255文字以内で入力してください',
            'product_image.required' => '商品画像をアップロードしてください',
            'product_image.mimes'    => '商品画像はjpegまたはpng形式でアップロードしてください',
            'categories.required'    => 'カテゴリーを選択してください',
            'condition.required'     => '商品の状態を選択してください',
            'price.required'         => '販売価格を入力してください',
            'price.min'              => '販売価格は0円以上で入力してください',
        ];
    }
}

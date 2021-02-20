<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name'=>'required|max:100',
            'image'=>'required|mimes:jpeg,png,jpg|min:1000|max:2500'
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Resim adı girilmesi zorunludur.',
            'name.max' => 'Resim adı uzunluğu 0-100 karakter arası olmak zorundadır.',
            'image.required' => 'Lütfen bir resim ekleyiniz.',
            'image.mimes' => 'Resim dosya uzantısı jpg,jpeg ya da png olmalıdır.',
            'image.min' => 'Resim boyutu çok küçük. Resim boyutu 1000Kb ile 2500Kb arasında olmalıdır',
            'image.max' => 'Resim boyutu çok büyük. Resim boyutu 1000Kb ile 2500Kb arasında olmalıdır'
        ];
    }
}

<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AvtoCreateRequest extends FormRequest
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
            'brand_avto' => 'required',
            'user' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'brand_avto.required' => 'Выберите марку автомобиля!',
            'user.required' => 'Выберите пользователя!',
        ];
    }
}

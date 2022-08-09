<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BorderCreateRequest extends FormRequest
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
            'id_citisen' => 'required',
            'way_crossing' => 'required',
            'user' => 'required',
        ];
    }
    public function messages()
    {
        return[
            'id_citisen.required' => 'Выберите гражданина!',
            'way_crossing.required' => 'Выберите транспортное средство!',
            'user.required' => 'Выберите пользователя!',
        ];
    }
}

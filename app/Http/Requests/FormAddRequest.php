<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormAddRequest extends FormRequest
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
            "name" => "required|min:3|max:8",
        ];
    }

//    public function messages()
//    {
//        return [
//            'name.required'=>"nhap cmm vao",
//            'name.min'=>"ngan qua",
//            'name.max'=>"dai vua thoi, dai qua roi"
//        ];
//    }
}

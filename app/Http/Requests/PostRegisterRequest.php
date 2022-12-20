<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRegisterRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required',
            'confirm_password'=>'required|same:password'
        ];
    }
    public function messages()
    {
        return [
            'name.required'=>'Tên không được để rỗng',
            'email.required'=>'Email không được để rỗng',
            'email.email'=>'Email không đúng định dạng',
            'email.unique'=>'Email đã tồn tại',
            'password.required'=>'Password không được để rỗng',
            'confirm_password.required'=>'Confirm Password không được để rỗng',
            'confirm_password.same'=>'Confirm Password không chính xác'
        ];
    }
}

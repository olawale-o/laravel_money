<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserFormRequest extends FormRequest
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
            "first_name" => "required",
            "last_name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|confirmed",
        ];
    }

    /**
     * Get the validation messages that apply to the request.
     *
     * @return array
     */

    public function messages()
    {

        return [
            "first_name.required" => ":attribute is required",
            "last_name.required" => ":attribute is required",
            "email.required" => ":attribute is required",
            "email.email" => ":attribute  address is not valid",
            "email.unique" => ":attribute  already exist",
            "password.required" => ":attribute is required",
        ];
    }

    /**
     * Get the validation attributes that apply to the request.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            "first_name" => "first name",
            "last_name" => "last name",
            "email" => "email address",
            "password" => "password",
        ];
    }
}

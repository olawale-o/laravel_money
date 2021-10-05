<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateAccountFormRequest extends FormRequest
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
            "account_type_id" => "required|exists:account_types,id",
            "user_id" => "required|exists:users,id",
            "balance" => "required",
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
            "account_type_id.required" => ":attribute is required",
            "user_id.required" => ":attribute is required",
            "account_type_id.exists" => "Please select :attribute from available ones",
            "user_id.exists" => "Please verify :attribute is registered",
            "balance.required" => ":attribute is required",
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
            "account_type_id" => "account",
            "user_id" => "user",
            "balance" => "balance",
        ];
    }
}

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
            "bank_id" => "required|exists:banks,id",
            "balance" => "required|numeric",
            "next_of_kin_first_name" => "required",
            "next_of_kin_last_name" => "required",
            "next_of_kin_phone_number" => "required",
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
            "bank_id.required" => ":attribute is required",
            "account_type_id.exists" => "Please select :attribute from available ones",
            "user_id.exists" => "Please verify :attribute is registered",
            "bank_id.exists" => "Please verify :attribute from available ones",
            "balance.required" => ":attribute is required",
            "balance.numeric" => ":attribute must be numeric",
            "next_of_kin_first_name.required" => ":attribute is required",
            "next_of_kin_last_name.required" => ":attribute is required",
            "next_of_kin_phone_number.required" => ":attribute is required",
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
            "bank_id" => "bank",
            "balance" => "balance",
            "next_of_kin_first_name" => "next of kin first name",
            "next_of_kin_last_name" => "next of kin last name",
            "next_of_kin_phone_number" => "next of kin phone number",
        ];
    }
}

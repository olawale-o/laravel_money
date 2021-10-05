<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TransactionFormRequest extends FormRequest
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
            "user_id" => "required|exists:users,id",
            "first_name" => "required",
            "last_name" => "required",
            "previous_balance" => "required",
            "amount" => "required",
            "description" => "required",
            "account_type_id" => "required|exists:account_types,id",
            "bank_id" => "required|exists:banks,id",
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
            "user_id" => "user",
            "first_name" => "first name",
            "last_name" => "last name",
            "previous_balance" => "balance",
            "amount" => "amount",
            "account_type_id" => "account",
            "bank_id" => "bank"
        ];
    }
}

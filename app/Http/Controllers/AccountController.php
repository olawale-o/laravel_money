<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAccountFormRequest;
use App\Models\Account;
use App\Models\kin;
use App\Models\Image;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Log;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
  protected $request;

   public function __construct(Request $request) {
     $this->request = $request;
   }
    //
    public function create(CreateAccountFormRequest $request)
    {
        $validate = $request->validated();
      try {
        $user = User::find($this->request->user()->id);
        $account = $user->accounts()->save($this->createAccount($validate));
        $kin = $account->kin()->save($this->createKin($validate));

        if ($account && $kin) {
            $signaturePath = $request->file('signature')->store('public/images');
            $nepaBillPath = $request->file('nepa_bill')->store('public/images');
            $account->images()->saveMany($this->createImage($signaturePath, $nepaBillPath));
         }

      } catch (\Exception $e) {
        Log::error($e->getMessage());
        $response = [
          'response' => [
            'success' => false,
            'message' => 'Something went wrong',
          ]
        ];
        return response($response, 500);
      }
      $response = [
        'response' => [
          'success' => true,
          'message' => 'Account created successfully',
        ]
      ];
      return response($response, 200);
    }

    private function generate_account_no()
    {
      $account_no = mt_rand(1000000000, 9999999999);

      if ($this->account_no_exist($account_no))
      {
        return generate_account_no();
      }

      return $account_no;

    }

    private function account_no_exist($number)
    {
      return Account::where('account_no', $number)->exists();
    }

    protected function createAccount($validate) {
      return new Account([
        'account_type_id' => $validate['account_type_id'],
        'user_id' => $validate['user_id'],
        'bank_id' => $validate['bank_id'],
        'balance' => $validate['balance'],
        'account_no' => $this->generate_account_no(),
      ]);
    }

    protected function createKin($validate) {
      return new Kin([
        'first_name' => $validate['next_of_kin_first_name'],
        'last_name' => $validate['next_of_kin_last_name'],
        'email' => $validate['next_of_kin_email'],
        'phone_number' => $validate['next_of_kin_phone_number'],
      ]);
    }

    protected function createImage($signaturePath, $nepaBillPath) {
      return [
        new Image([
          'path' => $signaturePath,
          'name' => 'signature',
          'created_at' => date('Y-m-d H:i:s'),
          ]),
        new Image([
          'path' => $nepaBillPath,
          'name' => 'nepa_bill',
          'created_at' => date('Y-m-d H:i:s'),
        ]),
      ];
    }
}

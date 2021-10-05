<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionFormRequest;
use Illuminate\Support\Facades\DB;
use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use App\Models\Transaction;

class TransactionController extends Controller
{
    //

    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    public function transfer(TransactionFormRequest $request)
    {
      return $this->handle_transfer($request);
    }

    private function handle_transfer($request)
    {
      $validated = $request->validated();
      $user = $this->save(['request' => $validated]);
      $response  = [
        'response' => [
          'user' => new UserResource($user),
          'message' => 'Amount transferred successfully',
          'success' => true
         ]
      ];
      return response($response, 200);

    }

    private function save($args)
    {
        $request = $args["request"];
        $user_id = $request["user_id"];
        $account = $request["account_type_id"];
        $first_name = $request["first_name"];
        $last_name = $request["last_name"];
        $balance = $request["previous_balance"];
        $amount = $request["amount"];
        $desc = $request["description"];
        $bank = $request["bank_id"];

        // validate balanace
        $db_balance = DB::table('account_type_user')->where([
            ['user_id', '=' , $user_id], ['account_type_id', '=' , $account]
        ])->value('balance');
        
        if (floatval($db_balance) !== floatval($balance)) {
            throw new Exception("Please provide a valid balance");
        }

        if (floatval($db_balance) < floatval($amount)) {
            throw new Exception("Insufficient funds");
        }

        $user = $this->user->findOrFail($user_id);

        $current_balance = floatval($db_balance) - floatval($amount);

        DB::transaction(function () use(
            $user_id, $account, $first_name, $last_name, $bank, $balance, $amount, $desc, $user, $current_balance, $db_balance) {
            
            $user->transactions()->create([
              'bank_id' => $bank,
              'description' => $desc,
              'amount' => floatval($amount),
              'current_balance' => $current_balance,
              'previous_balance' => $db_balance,
              'first_name' => $first_name,
              'last_name' => $last_name,
              'account_type_id' => floatval($account),
              'transaction_id' => $this->generate_transaction_no(),
            ]);

            DB::table('account_type_user')->where([
                ['user_id', '=' , $user_id], ['account_type_id', '=' , $account]
            ])->update(['balance' => $current_balance]);
        });
        return $user;
    }

    private function generate_transaction_no()
    {
      $transaction_id = uniqid();

      if ($this->transaction_no_exist($transaction_id))
      {
        return generate_transaction_no();
      }

      return $transaction_id;

    }

    private function transaction_no_exist($number)
    {
      return Transaction::where('transaction_id', $number)->exists();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CreateAccountFormRequest;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;

class AccountTypeController extends Controller
{
    //
    protected $user;
    public function __construct(UserRepositoryInterface $user)
    {
      $this->user = $user;
    }

    public function create(CreateAccountFormRequest $request)
    {
        return $this->handle_account_creation($request);
    }

    /**
    * Handle account creation
    * 
    * @param array
    * 
    * @return JsonResponse
    * 
    * 
    */

    private function handle_account_creation($request)
    {
        $validated = $request->validated();
        $user = $this->save(['request' => $validated]);
        $response  = [
          'response' => [
            'user' => new UserResource($user),
            'message' => 'Account created',
            'success' => true
           ]
        ];

        return response($response, 200);
    }

    private function save($args)
    {
        $request = $args["request"];
        $user_id = $request["user_id"];
        $user = $this->user->findOrFail($user_id);
        $user->account_types()->attach($request["account_type_id"], ['balance' => $request["balance"]]);
        return $user;
    }
}

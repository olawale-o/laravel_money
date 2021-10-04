<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Repositories\UserRepositoryInterface;
use App\Repositories\PasswordInterface;
use App\Http\Requests\LoginFormRequest;
use App\Http\Resources\UserResource;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    protected $user;
    protected $hash;

    /**
    * Create a new controller instance.
    *
    * @return void
    * 
    * @param \App\Repositories\UserRepositoryInterface
    * @param \App\Contracts\Password\PasswordInterface
    */
    public function __construct(UserRepositoryInterface $user, PasswordInterface $hash)
    {
        // $this->middleware('guest')->except('logout');
        $this->user  = $user;
        $this->hash  = $hash;
    }


    /**
     * Login user
     * 
     * @param \App\Http\Requests\LoginFormRequest|request;
     * 
     * @return JsonResponse
     * 
     */

    public function login(LoginFormRequest $request) {       
        return $this->loginUser($request);
    }

    /**
     * Login User
     * 
     * @param array
     * 
     * @return JsonResponse
     * 
     */

    private function loginUser($request)
    { 

        $validated = $request->validated();

        $user = $this->findUser(['request' => $validated]);

        if ($user) {
            if ($this->checkPassword(['request' => $request, 'user' => $user])) {
                $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'response' => [
                        'user' => new UserResource($user),
                        'token' => $token,
                        'success' => true,
                        'message' => 'User loggedin succesfully'
                    ]
                ];
                // event(new LoginEvent($user));
                return response($response, 200);
            } 
            
            $response = ["response" => [
                "message" => "Password mismatch",
                "success" => false
            ]];
            return response($response, 422);
            
        } else {

            $response = ['response' => [
                "message" =>'User does not exist',
                "success" => false
            ]];
            return response($response, 404);  
        }
        $response = ['response' => [
            "message" =>'Internal server error',
            "success" => false
        ]];
        return response($response, 500); 
    }

    /**
     * Check user
     * 
     * @param array
     * 
     * @return \App\Models\User
     * 
     */

    private function findUser($args) {
        $request = $args['request'];
        return $this->user->where('email', $request['email'])->first();
    }

    /**
     * Check password
     * 
     * @param array
     * 
     * @return boolean
     * 
     */
    private function checkPassword($args) {
        $request = $args['request'];
        $user = $args['user'];
        $args = ['password' => $request['password'], 'hash_password' => $user->password];
        return $this->hash->check($args);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateUserFormRequest;
use Illuminate\Support\Str;
use App\Repositories\PasswordInterface;
use App\Repositories\UserRepositoryInterface;
use App\Http\Resources\UserResource;
use Illuminate\Auth\Access\AuthorizationException;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
    * Where to redirect users after registration.
    *
    * @var string
    */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
    * Instance variable
    *
    * @var string
    */

    protected $user;
    protected $hash;

    /**
    * Create a new controller instance.
    *
    * @return void
    * 
    * @param \App\Repositories\UserRepositoryInterface
    * @param \App\Contracts\Password\PasswordContract
    */
    public function __construct(UserRepositoryInterface $user, PasswordInterface $hash)
    {
        // $this->middleware('guest');
        $this->user  = $user;
        $this->hash  = $hash;
    }

    /**
    * Register user
    * 
    * @param \App\Http\Requests\CreateUserFormRequest;
    * 
    * @return JsonResponse
    * 
    * 
    */
    public function register(CreateUserFormRequest $request) {
      return $this->registerUser($request); 
    }

    /**
    * Register user
    * 
    * @param array
    * 
    * @return JsonResponse
    * 
    * 
    */
    private function registerUser($request)
    {

      $validated = $request->validated();
      $user = $this->save_user(['request' => $validated]);
      if ($user) {
        $graceTimeInMinutes = 300;
        $expires  = time() + $graceTimeInMinutes;
        $token = $user->createToken('Laravel password Grant Client')->accessToken;           
        $response  = [
          'response' => [
            'user' => new UserResource($user),
            'token' => $token,
            'expires' => $expires,
            'success' => true
          ]
        ];          
        // event(new Registered($user));
        return response($response, 201);
      }
    
      $response =  [
        'response' => [
            'message' => 'Internal server error', 
            'success' => false
        ]
      ];
      return response($response, 500);
    }

    /**
     * Create new user
     * 
     * @param array
     * 
     * @return \App\Models\User
     * 
     * 
     */

    private function save_user($args)
    {
        //hash password and add other attributes before saving
        $request =  $args['request'];
        $args = ['password' => $request["password"] ];
        $request['password'] = $this->hash->make($args);
        $request['remember_token'] = Str::random(10);
        
        //save user to database
        return $this->user->create([
            "first_name" => $request['first_name'],
            "last_name" => $request['last_name'],
            "email" => $request['email'],
            "password" => $request['password'],
            "remember_token" => $request['remember_token'],
            "account_number" => $this->generate_account_no(),
        ]);
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
      return $this->user->where('account_number', $number)->exists();
    }
}

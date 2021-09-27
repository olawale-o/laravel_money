<?php
  namespace App\Repositories\Password;

  use Illuminate\Support\Facades\Hash;
  use App\Repositories\PasswordInterface;
  
  class Password implements PasswordInterface
  {
  
    protected $hash;
    /**
    * Create instance of Password
    * 
    * @param \Illuminate\Support\Facades\Hash
    * 
    * @return void
    */
    public function __construct(Hash $hash) {
        $this->hash = $hash;
    }

    /**
    * Check password
    * 
    * @param array
    * 
    * @return bool
    * 
    */
    public function check(array $args)
    {
        return $this->hash::check($args['password'], $args['hash_password']);
    }

    /**
    * Hash password
    * 
    * @param array
    * 
    * @return string
    * 
    */
    public function make(array $args)
    {
        return $this->hash::make($args['password']);
    }
  }
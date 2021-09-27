<?php
  namespace App\Repositories;

  interface PasswordInterface
  {

    /**
    * Check password
    * 
    * @param array
    * 
    * @return boolean
    * 
    */
    public function check(array $args);

    /**
    * Hash password
    * 
    * @param array
    * 
    * @return string
    * 
    */
    public function make(array $args);

  }

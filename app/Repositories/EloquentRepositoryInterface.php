<?php
  namespace App\Repositories;
  use Illuminate\Database\Eloquent\Model;
  use Illuminate\Database\Eloquent\Builder as Builder;
  use App\Models\User;

  interface EloquentRepositoryInterface
  {
    public function create(array $attributes) : Model;
    public function find($attribute) : ?Model;
    public function where(string $attribute, string $value) : Builder;
  }

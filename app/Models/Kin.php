<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kin extends Model
{
    use HasFactory;

    protected $table = 'kins';

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'first_name',
      'last_name',
      'email',
      'user_id',
    ];

    public function account()
    {
      return $this->belongsTo('App\Models\Account');
    }
}

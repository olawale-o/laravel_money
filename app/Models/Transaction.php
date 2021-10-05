<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const UPDATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'first_name',
      'last_name',
      'bank_id',
      'user_id',
      'account_type_id',
      'transaction_id',
      'previous_balance',
      'current_balance',
      'amount',
      'description'
    ];

    public function banks() {
      return $this->hasMany(Banks::class);
    }
}

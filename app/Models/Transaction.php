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
      'transaction_id',
      'sender_account_no',
      'receiver_account_no',
      'previous_balance',
      'current_balance',
      'amount',
      'charge',
      'description'
    ];

    public function sender() {
      return $this->hasMany(Account::class, 'sender_account_no');
    }

    public function receiver() {
      return $this->hasMany(Account::class, 'receiver_account_no');
    }
}

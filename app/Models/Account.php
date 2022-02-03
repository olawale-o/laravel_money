<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    public function user() {
      return $this->belongsTo(User::class);
    }

    public function transactions() {
      return $this->hasMany(Transaction::class);
    }

    public function bank() {
      return $this->belongsTo(Bank::class);
    }

    public function accountType() {
      return $this->belongsTo(AccountType::class);
    }
}

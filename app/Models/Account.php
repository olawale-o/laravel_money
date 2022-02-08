<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

      /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'account_type_id',
      'bank_id',
      'user_id',
      'balance',
      'account_no',
    ];

    public function user() {
      return $this->belongsTo('App\Models\Account');
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

    public function kin() {
      return $this->hasMany('App\Models\Kin');
    }

    public function images() {
      return $this->morphMany('App\Models\Image', 'imageable');
    }
}

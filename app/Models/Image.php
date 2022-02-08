<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
      'imageable_id',
      'imageable_type',
      'path',
      'name',
      'created_at',
    ];

    public function imageable() {
      return $this->morphTo();
    }
}

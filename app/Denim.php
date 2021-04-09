<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Denim extends Model
{
    protected $fillable = [
      'user_id',
      'bland_type',
      'waist',
      'wearing_count'
    ];
}

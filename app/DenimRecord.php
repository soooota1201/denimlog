<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenimRecord extends Model
{
    protected $fillable = [
      'denim_id',
      'wearing_day',
      'wearing_place',
      'body'
    ];
}

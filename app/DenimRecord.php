<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DenimRecord extends Model
{
    protected $fillable = [
      'user_id',
      'denim_id',
      'wearing_day',
      'wearing_place',
      'body'
    ];

    public function denim()
    {
      return $this->belongsTo(Denim::class);
    }
}

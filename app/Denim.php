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

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function denimRecords()
    {
      return $this->hasMany(DenimRecord::class);
    }
}

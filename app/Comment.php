<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
      'user_id',
      'denim_record_id',
      'body'
    ];

    public function denimRecord() {
      return $this->belongsTo(DenimRecord::class);
    }
    
    public function user() {
      return $this->belongsTo(User::class);
    }
} 

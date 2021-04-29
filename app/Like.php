<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    // 配列内の要素を書き込み可能にする
  protected $fillable = ['denim_record_id','user_id'];

  public function denimRecord()
  {
    return $this->belongsTo(DenimRecord::class);
  }

  public function user()
  {
    return $this->belongsTo(User::class);
  }
}

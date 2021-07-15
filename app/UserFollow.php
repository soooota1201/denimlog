<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserFollow extends Model
{
    protected $fillable = [
        'following_id',
        'followed_id'
    ];

    public function followingIds($user_id)
    {
      return $this->where('following_id', $user_id)->get();
    }

    public function followedIds($user_id)
    {
      return $this->where('followed_id', $user_id)->get();
    }

}

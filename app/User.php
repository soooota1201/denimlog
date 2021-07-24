<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'name', 'weight', 'height', 'user_profile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function denims()
    {
      return $this->hasMany(Denim::class);
    }

    public function denimRecords()
    {
      return $this->hasMany(DenimRecord::class);
    }

    public function followings()
    {
      return $this->belongsToMany(User::class, 'user_follows', 'following_id', 'followed_id')->withTimestamps();
    }


    public function followers()
    {
      return $this->belongsToMany(User::class, 'user_follows', 'followed_id', 'following_id')->withTimestamps();
    }

    public function is_following($userId)
    {
      return $this->followings()->where('followed_id', $userId)->exists();
    }

    public function follow($userId)
    {
      $existing = $this->is_following($userId);
      $myself = $this->id == $userId;
      if (!$existing && !$myself) {
          $this->followings()->attach($userId);
      }
    }

    public function unfollow($userId)
    {
      $existing = $this->is_following($userId);
      $myself = $this->id == $userId;
      if ($existing && !$myself) {
        $this->followings()->detach($userId);
      }
    }

    public function getFollowUsersId($user_id, $following_ids)
    {
      return $this->whereIn('id', $following_ids)->get();
    }

    public function getFollowedUsersId($user_id, $followed_ids)
    {
      return $this->whereIn('id', $followed_ids)->get();
    }

    public function favorites()
    {
      return $this->belongsToMany('App\DenimRecord')->withTimestamps();
    }

}

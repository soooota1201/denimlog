<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class DenimRecord extends Model
{
    protected $fillable = [
      'user_id',
      'denim_id',
      'wearing_day',
      'wearing_place',
      'body',
      'bland_type'
    ];

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function denim()
    {
      return $this->belongsTo(Denim::class);
    }

    /**
     * Get all of the comments for the DenimRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function denimRecordImages()
    {
        return $this->hasMany(DenimRecordImage::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function is_liked_by_auth_user()
  {
    $id = Auth::id();

    $likers = array();
    foreach($this->likes as $like) {
      array_push($likers, $like->user_id);
    }

    if (in_array($id, $likers)) {
        return true;
      } else {
        return false;
      }
  }

  public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
}

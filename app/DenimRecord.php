<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\DenimRecordImage;

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

    /**
     * Get all of the comments for the DenimRecord
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function denimRecordImages()
    {
        return $this->hasMany(DenimRecordImage::class);
    }
}

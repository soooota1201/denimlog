<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Denim;

class DenimImage extends Model
{
    protected $fillable = [
      'denim_id',
      'cloud_image_path',
      'cloud_image_id',
    ];

    public function denim() {
      return $this->belongsTo(Denim::class);
    }
}

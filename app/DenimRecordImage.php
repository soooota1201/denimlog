<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\denimRecord;

class DenimRecordImage extends Model
{
    protected $fillable = [
      'denim_record_id',
      'cloud_record_image_id',
      'cloud_record_image_path',
    ];

    /**
     * Get the user that owns the DenimRecordImage
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function denimRecord()
    {
        return $this->belongsTo(DenimRecord::class);
    }
}

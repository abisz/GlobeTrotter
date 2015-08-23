<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Picture extends Model
{
    protected $fillable = [
        'trip_entry_id',
        'title',
        'desc',
        'filename',
    ];

    /**
     * a picture belongs to one tripEntry
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tripEntry()
    {
        return $this->belongsTo('\App\TripEntry');
    }
}

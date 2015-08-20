<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripEntry extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'date',
        'trip_id'
    ];

    protected $dates=['date'];

    public function setDateAttribute($date){

        $this->attributes['date'] = Carbon::parse($date);

    }

    /**
     * an entry belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo('\App\Trip');
    }

    /**
     * an entry has many Pictures
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function pictures()
    {
        return $this->hasMany('\App\Picture');
        }
}


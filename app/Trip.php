<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Trip extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'start',
        'end',
        'pic',
        'user_id'
    ];

    protected $dates= ['start', 'end'];

    public function setStartAttribute($date){

        $this->attributes['start'] = Carbon::parse($date);

    }

    public function setEndAttribute($date){

        $this->attributes['end'] = Carbon::parse($date);

    }

    public function getStartAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function getEndAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function scopeAlreadyStarted($query)
    {
        $query->where('start', '<=', Carbon::now());
    }
    /**
     * a trip belongs to one user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }

    /**
     * a trip has many tripEntries
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tripEntries()
    {
        return $this->hasMany('\App\TripEntry');
        }

}

<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class TripEntry extends Model
{
    protected $fillable = [
        'name',
        'desc',
        'date',
        'trip_id',
        'pic',
        'lat',
        'lng'
    ];

    protected $dates=['date'];

    /**
     * stores date attribute as Carbon instance
     *
     * @param $date
     */
    public function setDateAttribute($date){

        $this->attributes['date'] = Carbon::parse($date);

    }

    /**
     * create a new TripEntry with Trip_id set
     *
     * @param $attr
     * @param $id
     * @return static
     */
    public static function createWithTripId($attr, $id){

        $attr['trip_id'] = $id;
        return TripEntry::create($attr);

        }

    /**
     * stores new featured image-id into db
     *
     * @param $pic_id
     */
    public function setFeaturedImage($pic_id){

        $this->pic = $pic_id;
        $this->save();

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


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

    /**
     * save start attribute as a Carbon instance
     *
     * @param $date
     */
    public function setStartAttribute($date){

        $this->attributes['start'] = Carbon::parse($date);

    }

    /**
     * save end attribute as a Carbon instance
     *
     * @param $date
     */
    public function setEndAttribute($date){

        $this->attributes['end'] = Carbon::parse($date);

    }

    /**
     * get start attribute as Carbon instance
     *
     * @param $date
     * @return static
     */
    public function getStartAttribute($date)
    {
        return Carbon::parse($date);
    }

    /**
     * get end attribute as Carbon instance
     *
     * @param $date
     * @return static
     */
    public function getEndAttribute($date)
    {
        return Carbon::parse($date);
    }

    /**
     * filter trips for the ones allready started
     *
     * @param $query
     */
    public function scopeAlreadyStarted($query)
    {
        $query->where('start', '<=', Carbon::now());
    }

    /**
     * stores new featured Image-id into db
     *
     * @param $pic_id
     */
    public function setFeaturedImage($pic_id){

        $this->pic = $pic_id;
        $this->save();

    }

    /**
     * create Trip with user id
     *
     * @param $attr
     * @param $id
     * @return static
     */
    public static function createWithUserId($attr, $id){
        $attr['user_id'] = $id;
        return Trip::create($attr);
    }

    /**
     * get all entries associated with a trip containing the filename for the featured image of the entry
     *
     * @return mixed
     */
    public function getEntriesWithPic()
    {
        $entries = $this->tripEntries()->get();

        //retrieving path of featured images
        foreach($entries as $entry){
            if($entry['pic']){
                $pic = Picture::findOrFail($entry['pic']);
                $entry['picName'] = $pic->filename;
            }
        }

        return $entries;

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

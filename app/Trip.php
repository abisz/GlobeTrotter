<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Picture;

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
     * Returns Featured Image if set, or false
     *
     * @return mixed
     */
    public function getFeaturedImage()
    {
        if($this->pic){
            $pic = Picture::findOrFail($this->pic);
            return $pic;
        }else{
            return false;
        }

    }

    /**
     * Returns random Trips with featured image filename
     *
     * @param $amount
     * @return mixed
     */
    public static function getRandomTrips($amount)
    {
        $trips = Trip::all()->random($amount)->shuffle();

        foreach($trips as $trip){
            if($pic = $trip->getFeaturedImage()){
                $trip->picName = $pic->filename;
            }
        }

        return $trips;

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
     * returns entries with additional content attribute for map implementation
     * if there are no entries it returns false
     *
     * @return mixed
     */
    public function getMarkers()
    {
        if($entries = $this->tripEntries()->get()){
            foreach ($entries as $entry){
                $entry['content']= '<a href="'.url('trip').'/'.$this->id.'/entry/'.$entry->id.'"/>'.$entry->name.'</a><br/><i>'.$entry->date->format('d-m-Y').'</i>';
            }
            return $entries;
        }

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

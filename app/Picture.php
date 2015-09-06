<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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

    public static function createPicture($attr, $image, $user_id, $entry_id){

        //creating Pictures entry into db
        $newPicture = $attr;
        unset($newPicture->image);
        $newPicture['trip_entry_id'] = $entry_id;

        $pic = Picture::create($newPicture);

        $pic->saveImage($image, $user_id);

        return $pic;
    }


    /**
     * Save image (and deletes old one if it exists) and updates Picture Object
     *
     * @param $image
     * @param $user_id
     * @return bool|int
     */
    public function saveImage($image, $user_id){

        //deleting old image
        if(File::exists(public_path('img').'/'.$user_id.'/'.$this->filename)){
            $oldPath = public_path('img').'/'.$user_id.'/'.$this->filename;
            File::delete($oldPath);
        }

        //modifying and saving image
        $destinationPath = 'img/'.$user_id;
        $extension = $image->getClientOriginalExtension();
        $filename = uniqid().'.'.$extension;

        $image->move($destinationPath, $filename);

        $this['filename']= $filename;
        return $this->update();
    }

    /**
     * deletes item and according image, also updates trip and entry that use this picture as featured image
     *
     * @param $user_id
     * @throws \Exception
     */
    public function deleteWithImage($user_id)
    {
        if($entry = TripEntry::where('pic', $this->id)->first()){
            $entry->pic = null;
            $entry->save();
        }
        if($trip = Trip::where('pic', $this->id)->first()){
            $trip->pic = null;
            $trip->save();
        }

        //deleting image as well
        File::delete(public_path('img').'/'.$user_id.'/'.$this->filename);
        $this->delete();

    }

}

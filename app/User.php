<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Support\Facades\File;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * deletes profile pic and saves new one
     *
     * @param $image
     */
    public function updateProfilePic($image){

        //deleting old image
        $path = public_path('img').'/'.$this->id.'/profile-pic.jpg';
        File::delete($path);

        //modifying and saving new image
        $destinationPath = 'img/' . $this->id;
        $filename = 'profile-pic.jpg' ;

        $image->move($destinationPath, $filename);

        }

    /**
     * delete folder, containing all the pictures, the user uploaded
     *
     */
    public function destroyPics(){
        //delete all pics from user
        $folderPath = public_path('img').'/'.$this->id;
        File::deleteDirectory($folderPath);
        }

    /**
     * Get all Trips from user that allreay started sorted by end-date (desc)
     *
     * @return mixed
     */
    public function getTripsForMyTrips()
    {
        //get all trips that allready started, sorted by date desc
        $trips = $this->trips()->latest('end')->alreadyStarted()->get();

        //retrieving path of featured images
        foreach($trips as $trip){
            if($trip['pic']){
                $pic = Picture::findOrFail($trip['pic']);
                $trip['picName'] = $pic->filename;
            }
        }

        return $trips;

    }

    /**
     * a user has many trips
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany('\App\Trip');
    }
}

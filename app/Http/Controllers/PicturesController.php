<?php

namespace App\Http\Controllers;

use App\Http\Requests\PictureRequest;
use App\Picture;
use App\Trip;
use App\TripEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class PicturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $trip_id
     * @param $entry_id
     * @return Response
     */
    public function create($trip_id, $entry_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        $user = Auth::user();
        if($user->id == $trip->user_id && $trip->id == $entry->trip_id){
            return view('pictures.create', compact('trip', 'entry'));
        }else{
            return 'You are not authorized to upload a picture to this entry!';
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param PictureRequest|Request $request
     * @param $trip_id
     * @param $entry_id
     * @return Response
     */
    public function store(PictureRequest $request, $trip_id, $entry_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        $user = Auth::user();

        if($user->id == $trip->user_id && $trip->id == $entry->trip_id){

            $pic = Picture::createPicture($request->all(), Input::file('image'), $user->id, $entry_id);

            //check for checkboxes if picture should be featured somewhere
            if(Input::has('featuredEntry')){
                $entry->setFeaturedImage($pic->id);
            }
            if(Input::has('featuredTrip')){
                $trip->setFeaturedImage($pic->id);
            }

            return redirect(url('trip/'.$trip->id.'/entry/'.$entry_id));

        }else{
            return 'You are not authorized to upload a picture to this entry!';
        }
    }

    /**
     * Display the specified resource.
     *
     * @param $trip_id
     * @param $entry_id
     * @param $pic_id
     * @return Response
     * @internal param int $id
     */
    public function show($trip_id, $entry_id, $pic_id)
    {
        $trip = Trip::findOrFail($trip_id);
        //$pic = Picture::findOrFail($pic_id);
        $pic = Picture::getSinglePic($pic_id);
        $entry = TripEntry::findOrFail($entry_id);
        $user_id = $trip->user_id;
        $single_pic = true;
        return view('pictures.single', compact('pic', 'trip', 'entry', 'user_id', 'single_pic'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $trip_id
     * @param $entry_id
     * @param $pic_id
     * @return Response
     * @internal param int $id
     */
    public function edit($trip_id, $entry_id, $pic_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $pic = Picture::findOrFail($pic_id);
        $entry = TripEntry::findOrFail($entry_id);
        if(Auth::user()->id == $trip->user_id){
            return view('pictures.edit', compact('trip', 'entry', 'pic'));
        }else{
            return 'You are not authorized to edit this Picture';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PictureRequest|Request $request
     * @param $trip_id
     * @param $entry_id
     * @param $pic_id
     * @return Response
     * @internal param int $id
     */
    public function update(PictureRequest $request, $trip_id, $entry_id, $pic_id)
    {
        $user = Auth::user();
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);

        if($user->id == $trip->user_id && $trip->id == $entry->trip_id) {

            $pic = Picture::findOrFail($pic_id);

            //Checking if user wants to update the picture
            if ($request['image']) {
               $pic->saveImage($request['image'], $user->id);
            }

            $pic->update($request->all());

            //check for checkboxes if picture should be featured somewhere
            if(Input::has('featuredEntry')){
                $entry->setFeaturedImage($pic->id);
            }
            if(Input::has('featuredTrip')){
                $trip->setFeaturedImage($pic->id);
            }

            Session::flash('flash_message', 'Your Picture was successfully updated!');

            return redirect(url('trip') . '/' . $trip_id . '/entry/' . $entry->id . '/picture/' . $pic_id);

        }else{
            return 'You are not authorized to edit this Picture!';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $trip_id
     * @param $entry_id
     * @param $pic_id
     * @return Response
     * @internal param int $id
     */
    public function destroy($trip_id, $entry_id, $pic_id)
    {
        $pic = Picture::findOrFail($pic_id);
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        $user = Auth::user();

        if(Auth::user()->id == $trip->user_id && $trip->id == $entry->trip_id && $pic->trip_entry_id == $entry->id){

            $pic->deleteWithImage($user->id);

            return redirect(url('trip') . '/' . $trip_id . '/entry/' . $entry->id );

        }else{
            return 'You are not authorized to delete this picture!';
        }
    }
}

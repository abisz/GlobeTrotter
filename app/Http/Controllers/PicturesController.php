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

            //modifying and saving image
            $destinationPath = 'img/'.$user->id;
            $image = Input::file('image');
            $extension = $image->getClientOriginalExtension();
            $filename = uniqid().'.'.$extension;

            $image->move($destinationPath, $filename);

            //creating Pictures entry into db
            $newPicture = $request->all();
            unset($newPicture->image);
            $newPicture['trip_entry_id'] = $entry_id;
            $newPicture['filename'] = $filename;
            Picture::create($newPicture);
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
        $pic = Picture::findOrFail($pic_id);
        $entry = TripEntry::findOrFail($entry_id);
        return view('pictures.single', compact('pic', 'trip', 'entry'));
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
        $pic = Picture::findOrFail($pic_id);

        if($user->id == $trip->user_id && $trip->id == $entry->trip_id) {

            $picture = Picture::findOrFail($pic_id);

            //Checking if user wants to update the picture
            if ($request['image']) {
                //deleting old image
                $oldPath = public_path('img').'/'.$user->id.'/'.$pic->filename;
                File::delete($oldPath);

                //modifying and saving new image
                $destinationPath = 'img/' . $user->id;
                $image = Input::file('image');
                $extension = $image->getClientOriginalExtension();
                $filename = uniqid() . '.' . $extension;

                $image->move($destinationPath, $filename);
                $picture['filename'] = $filename;
            }

            $picture->update($request->all());
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
            $pic->delete();

            //deleting image as well
            File::delete(public_path('img').'/'.$user->id.'/'.$pic->filename);

            return redirect(url('trip') . '/' . $trip_id . '/entry/' . $entry->id );

        }else{
            return 'You are not authorized to delete this picture!';
        }
    }
}

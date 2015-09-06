<?php

namespace App\Http\Controllers;

use App\Picture;
use App\Trip;
use App\User;
use App\Entry;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\Session;


class TripsController extends Controller
{

    /**
     * Show all Trips, which start date is in the past, order desc by the end, from a specific user
     * @param $user_id
     * @return \Illuminate\View\View
     */
    public function showAllTrips($user_id)
    {
        $user = User::findOrFail($user_id);
        $trips = $user->getTripsForMyTrips();

        return view('trips.myTrips', compact('trips', 'user_id'));
    }

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
     * @return Response
     */
    public function create()
    {
        return view('trips.create');
    }

    /**
     * validates and stores a new trip and directs to the detail page
     * @param Requests\TripRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Requests\TripRequest $request)
    {
        $input = $request->all();
        $trip = Trip::createWithUserId($input, Auth::user()->id);
        return redirect(url('trip/'.$trip->id));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $trip = Trip::findOrFail($id);
        $entries = $trip->getEntriesWithPic();
        $user_id = $trip->user_id;
        $map = 'single-trip';
        return view('trips.single', compact('trip', 'entries', 'user_id', 'map'));
    }


    /**
     * Show the form for editing the specified resource, if authenticated user is owner
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $trip = Trip::findOrFail($id);
        if(Auth::user()->id == $trip->user_id){
            return view('trips.edit', compact('trip'));
        }else{
            return 'You are not authorized to edit this trip';
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\TripRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Requests\TripRequest $request, $id)
    {
        $trip = Trip::findOrFail($id);
        $trip->update($request->all());

        Session::flash('flash_message', 'Your Trip was successfully updated!');

        return redirect(route('tripDetail',$id));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $trip = Trip::findOrFail($id);
        if(Auth::user()->id == $trip->user_id){
            $trip->delete();
            return redirect(route('myTrips', Auth::user()->id));
        }else{
            return 'You are not authorized to delete this trip!';
        }
    }

    /**
     * gets entries, prepared for map (with content attribute) and returns them
     *
     * @param $id
     * @return string
     */
    public function getMarkers($id){
        $trip = Trip::findOrFail($id);
        if($entries = $trip->getMarkers()){
           return $entries;
        }else{
            return 'no entries available';
        }



        }
}

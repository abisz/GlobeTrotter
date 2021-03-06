<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryRequest;
use App\Trip;
use App\TripEntry;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TripEntriesController extends Controller
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
     * Returning view for creating a new Entry
     * @param $trip_id
     * @return \Illuminate\View\View
     */
    public function create($trip_id)
    {
        $trip = Trip::findOrFail($trip_id);
        if(Auth::user()->id == $trip->user_id){
            $map = "create";
            return view('entries.create', compact('trip', 'map'));
        }else{
            return 'You are not the owner of this trip!';
        }

    }

    /**
     * Store a newly created resource in storage, if authenticated user is owner of the trip
     *
     * @param  EntryRequest $request
     * @param $trip_id
     * @return Response
     */
    public function store(EntryRequest $request, $trip_id)
    {
        $trip = Trip::findOrFail($trip_id);

        if($trip->user_id == Auth::user()->id){

            $entry = TripEntry::createWithTripId($request->all(), $trip_id);
            return redirect(url('trip/'.$trip->id.'/entry/'.$entry->id));

        }else{
            return 'You are not authorized to create an entry for this trip';
        }


    }

    /**
     * Display the specified resource.
     *
     * @param $trip_id
     * @param $entry_id
     * @return Response
     * @internal param int $id
     */
    public function show($trip_id, $entry_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        $pics = $entry->pictures()->get();
        $user_id = $trip->user_id;
        $map = "single-entry";
        return view('entries.single', compact('entry', 'trip', 'pics', 'user_id', 'map'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $trip_id
     * @param $entry_id
     * @return Response
     * @internal param int $id
     */
    public function edit($trip_id, $entry_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        if(Auth::user()->id == $trip->user_id){
            $map = "update";
            return view('entries.edit', compact('entry', 'trip', 'map'));
        }else{
            return 'You are not authorized to edit this entry';
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EntryRequest $request
     * @param $trip_id
     * @param $entry_id
     * @return Response
     * @internal param int $id
     */
    public function update(EntryRequest $request, $trip_id, $entry_id)
    {
        $entry = TripEntry::findOrFail($entry_id);
        $entry->update($request->all());

        Session::flash('flash_message', 'Your Entry was successfully updated!');

        return redirect(url('trip').'/'.$trip_id.'/entry/'.$entry->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $trip_id
     * @param $entry_id
     * @return Response
     * @internal param int $id
     */
    public function destroy($trip_id, $entry_id)
    {
        $trip = Trip::findOrFail($trip_id);
        $entry = TripEntry::findOrFail($entry_id);
        if(Auth::user()->id == $trip->user_id){
            $entry->delete();
            return redirect(url('trip').'/'.$trip_id);
        }else{
            return 'You are not authorized to delete this entry!';
        }
    }

    /**
     * returns JSON of requested entry
     *
     * @param $trip_id
     * @param $entry_id
     * @return mixed
     */
    public function getMarker($trip_id, $entry_id)
    {
        $entry = TripEntry::findOrFail($entry_id);

        return $entry;
        }
}

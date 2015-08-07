<?php

namespace App\Http\Controllers;

use App\Trip;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TripsController extends Controller
{

    public function index(){

        $trips = Trip::all();

        return view('trips', compact('trips'));
    }

    public function show($id)
    {
        $trip = Trip::findorFail($id);

        if(is_null($trip)){
            abort(404);
        }else {
            return view('trip', compact('trip'));
        }
    }

}

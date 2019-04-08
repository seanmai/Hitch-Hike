<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;

class TripsController extends Controller
{
    public function index(){
        $trips = Trip::all();
        return view('trips.index', ['trips' => $trips]);
    }

    public function create(){
        return view ('trips.create');
    }

    public function show(Trip $trip){
        return view('trips.show', ['trip' => $trip]);
    }

    public function store(){
        Trip::create([
            'title' => request('title'),
            'driver_id' => auth()->id(),
            'description' => request('description'),
            'pickup' => request('pickup'),
            'dropoff' => request('dropoff'),
            'available_seats' => request('available_seats'),
            'departure_time' => request('departure_time')
        ]);

        return redirect('/trips');
    }

    public function edit(Trip $trip){
        $this->authorize('update', $trip);

        return view('trips.edit', ['trip' => $trip]);
    }

    public function update(Trip $trip){
        $this->authorize('update', $trip);

        $trip->update(request(['title', 4, 'description', 'pickup', 'dropoff', 'available_seats', 'departure_time']));

        return redirect('/trips');
    }

    public function destroy(Trip $trip){
        $this->authorize('delete', $trip);

        $trip->delete();

        return redirect('/trips');
    }
}


//$trips = Trips::where('driver_id', auth()->id())->get();

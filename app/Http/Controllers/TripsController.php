<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Trip;
use App\UserTrip;

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

        $trip->update(request(['title', auth()->id(), 'description', 'pickup', 'dropoff', 'available_seats', 'departure_time']));

        return redirect('/trips');
    }

    public function destroy(Trip $trip){
        $this->authorize('delete', $trip);

        $trip->delete();

        return redirect('/trips');
    }


    public function showusers(){
        $tripsdriving = Trip::where('driver_id', auth()->id())->get();
        $tripsjoined = Trip::select('*', \DB::raw("trips.id as id"))->join('user_trips', 'user_trips.trip_id', '=', 'trips.id')
                           ->where('user_trips.user_id', auth()->id())->get();
        $trips = $tripsdriving->toBase()->merge($tripsjoined);
        return view('trips.showusers', ['trips' => $trips]);
    }

    public function add(Trip $trip){
        // $this->authorize('add', $trip);

        // $trip->decrement('available_seats');
        // UserTrip::create([
        //     'user_id' => auth()->id(),
        //     'trip_id' => 'id'
        // ]);

        return redirect('/trips');
    }

    public function leave(Trip $trip){
        // $this->authorize('leave', $trip);

        // $trip->increment('available_seats');
        // $usertrip = UserTrip::where('trip_id', $trip.id);
        // $usertrip->delete();

        return redirect('/trips');
    }
}

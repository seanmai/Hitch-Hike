<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Trip;
use App\UserTrip;

class TripsController extends Controller
{
    public function index(){
        $trips = Trip::where('available_seats', '>', 0)->get();
        return view('trips.index', ['trips' => $trips]);
    }

    public function create(){
        return view ('trips.create');
    }

    public function show(Trip $trip){
        $driver = User::where('id', $trip->driver_id)->first();
        $passengers = User::select('*', \DB::raw("users.id as id"))->join('user_trips', 'user_trips.user_id', '=', 'users.id')
                           ->where('user_trips.trip_id', $trip->id)->get();
        // return dd($passengers);
        return view('trips.show', ['driver' => $driver, 'trip' => $trip, 'passengers' => $passengers]);
    }

    public function store(){
        request()->validate([
            'title' => 'required',
            'description' => 'required',
            'available_seats' => 'required',
            'departure_time' => 'required',
        ]);

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

        $usertrips = UserTrip::where('trip_id', $trip->id);
        $trip->delete();
        $usertrips->delete();

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
        $this->authorize('add', $trip);

        $trip->decrement('available_seats');
        UserTrip::create([
            'user_id' => auth()->id(),
            'trip_id' => $trip->id
        ]);

        return redirect('/trips');
    }

    public function remove(Trip $trip){
        $this->authorize('leave', $trip);
        $trip->increment('available_seats');
        $usertrip = UserTrip::where([['trip_id', $trip->id], ['user_id', auth()->id()]]);
        $usertrip->delete();

        return redirect('/trips');
    }
}

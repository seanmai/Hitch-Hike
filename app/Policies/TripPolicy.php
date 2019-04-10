<?php

namespace App\Policies;

use App\User;
use App\Trip;
use App\UserTrip;
use Illuminate\Auth\Access\HandlesAuthorization;

class TripPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can update the trip.
     *
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function update(User $user, Trip $trip)
    {
        return ($trip->driver_id == $user->id);
    }

    /**
     * Determine whether the user can join the trip.
     *     Not the user's trip and they are not already a part of the trip and more than 0 seats
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function add(User $user, Trip $trip)
    {
        if(UserTrip::where([['user_id', $user->id], ['trip_id', $trip->id]])->doesntExist()){
            if($trip->driver_id != $user->id && $trip->available_seats > 0){
                return true;
            }
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can leave the trip.
     *     Not the user's trip and they are already a part of the trip
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function leave(User $user, Trip $trip)
    {
        if(UserTrip::where([['user_id', $user->id], ['trip_id', $trip->id]])->exists()){
            if($trip->driver_id != $user->id){
                return true;
            }
        } else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the trip.
     *
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function delete(User $user, Trip $trip)
    {
        return ($trip->driver_id == $user->id);
    }
}

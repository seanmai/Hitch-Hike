<?php

namespace App\Policies;

use App\User;
use App\Trip;
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
     *
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function add(User $user, Trip $trip)
    {
        //Not the user's trip and they are not already a part of the trip
        // return $result = DB::table('YOUR_TABLE')->where('FIELD','OP','VALUE')->exists(); and seats >0
        return !($trip->driver_id == $user->id) /* && UserTrip table doesn't have driverid == and tripid== */;
    }

    /**
     * Determine whether the user can leave the trip.
     *
     * @param  \App\User  $user
     * @param  \App\Trip  $trip
     * @return mixed
     */
    public function leave(User $user, Trip $trip)
    {
        //Not the user's trip and they are already a part of the trip
        return ($trip->driver_id == $user->id);
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

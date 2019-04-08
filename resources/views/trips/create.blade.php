@extends('layout')

@section('content')
<!DOCTYPE html>
    <h1>Create a trip!</h1>
    <form class="" action="/trips" method="POST">
        {{ csrf_field() }}
        <div class="">
            <input type="text" name="title" placeholder="Title" required>
        </div>
        <div class="">
            <textarea name="description" placeholder="Description" rows="8" cols="80" required></textarea>
        </div>
        <div class="">
            <input type="text" name="pickup" placeholder="Pick Up location" required>
        </div>
        <div class="">
            <input type="text" name="dropoff" placeholder="Drop Off location" required>
        </div>
        <div class="">
            <input type="number" name="available_seats" placeholder="Available Seats" required>
        </div>
        <div class="">
            <input type="text" name="departure_time" placeholder="Departure Time" required>
        </div>
        <button type="submit">Create trip</button>
    </form>
@endsection

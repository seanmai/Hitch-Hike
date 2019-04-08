@extends('layout')

@section('content')
    <h1>Edit trip</h1>
    <form class="" action="/trips/{{ $trip->id }}" method="POST">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="">
            <input type="text" name="title" placeholder="Title" value="{{ $trip->title }}" required>
        </div>
        <div class="">
            <textarea name="description" placeholder="Description" rows="8" cols="80" required>{{ $trip->description }}</textarea>
        </div>
        <div class="">
            <input type="text" name="pickup" placeholder="Pick Up location" value="{{ $trip->pickup }}" required>
        </div>
        <div class="">
            <input type="text" name="dropoff" placeholder="Drop Off location" value="{{ $trip->dropoff }}" required>
        </div>
        <div class="">
            <input type="number" name="available_seats" placeholder="Available Seats" value="{{ $trip->available_seats }}" required>
        </div>
        <div class="">
            <input type="text" name="departure_time" placeholder="Departure Time" value="{{ $trip->departure_time }}" required>
        </div>
        <button type="submit">Update trip</button>
    </form>

    <form class="" action="/trips/{{ $trip->id }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Delete trip</button>
    </form>
@endsection

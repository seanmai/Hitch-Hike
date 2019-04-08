@extends('layout')

@section('content')
    <h1>{{ $trip->title }}</h1>
    <p>{{ $trip->description }}</p>
    <p>Available Seats: {{ $trip->available_seats }}</p>
    <p>Departure Time: {{ $trip->departure_time }}</p>
    @can('update', $trip)
        <a href="/trips/{{ $trip->id }}/edit"><button type="button" name="button">Edit</button></a>
    @endcan
@endsection

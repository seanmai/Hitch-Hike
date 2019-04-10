@extends('layout')

@section('content')
    <h1>{{ $trip->title }}</h1>
    <p>{{ $trip->description }}</p>
    <p>Driver: {{ $driver->name }}</p>
    <p>Available Seats: {{ $trip->available_seats }}</p>
    <p>Departure Time: {{ $trip->departure_time }}</p>
    <h4>Passengers:</h4>
    @foreach ($passengers as $passenger)
        <p>{{ $passenger->name }}</p>
    @endforeach
    @can('update', $trip)
        <a href="/trips/{{ $trip->id }}/edit"><button type="button" name="button">Edit</button></a>
    @endcan
    @can('add', $trip)
        <form class="" action="/trips/{{ $trip->id }}/join" method="POST">
            @method('PUT')
            @csrf
            <button type="submit">Join trip</button>
        </form>
    @endcan
    @can('leave', $trip)
        <form class="" action="/trips/{{ $trip->id }}/leave" method="POST">
            @method('PUT')
            @csrf
            <button type="submit">Leave trip</button>
        </form>
    @endcan

@endsection

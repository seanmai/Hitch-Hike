@extends('layout')

@section('content')
<!DOCTYPE html>
    <h1>Create a trip!</h1>
    <form class="" action="/trips" method="POST">
        {{ csrf_field() }}
        @if ($errors->any())
        @endif
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        <div class="">
            <input type="text" name="title" placeholder="Title" required value="{{ old('title') }}">
        </div>
        <div class="">
            <textarea name="description" placeholder="Description" rows="8" cols="80" required value="{{ old('description') }}"></textarea>
        </div>
        <div class="">
            <input type="text" name="pickup" placeholder="Pick Up location" required value="{{ old('pickup') }}">
        </div>
        <div class="">
            <input type="text" name="dropoff" placeholder="Drop Off location" required value="{{ old('dropoff') }}">
        </div>
        <div class="">
            <input type="number" name="available_seats" placeholder="Available Seats" required value="{{ old('available_seats') }}">
        </div>
        <div class="">
            <input type="text" name="departure_time" placeholder="Departure Time" required value="{{ old('departure_time') }}">
        </div>
        <button type="submit">Create trip</button>
    </form>
@endsection

@extends('layout')

@section('content')
    <div class="container" style="padding-top: 55px;">
        <h1>Create a trip</h1>
        <form class="" action="/trips" method="POST">
            {{ csrf_field() }}
            @if ($errors->any())
            @endif
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-describedby="title" placeholder="Enter title" required value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3" aria-describedby="description" placeholder="Enter description" required value="{{ old('description') }}"></textarea>
            </div>
            <div class="form-group">
                <label for="pickup">Pickup Location</label>
                <input type="text" class="form-control" name="pickup" id="pickup" aria-describedby="pickup" placeholder="Enter pickup location" required value="{{ old('pickup') }}">
            </div>
            <div class="form-group">
                <label for="dropoff">Dropoff Location</label>
                <input type="text" class="form-control" name="dropoff" id="dropoff" aria-describedby="dropoff" placeholder="Enter dropoff location" required value="{{ old('dropoff') }}">
            </div>
            <div class="form-group">
                <label for="available_seats">Available Seats</label>
                <input type="text" class="form-control" name="available_seats" id="available_seats" aria-describedby="available_seats" placeholder="Enter available seats" required value="{{ old('available_seats') }}">
            </div>
            <div class="form-group">
                <label for="departure_time">Departure Time</label>
                <input type="text" class="form-control" name="departure_time" id="departure_time" aria-describedby="departure_time" placeholder="Enter departure time" required value="{{ old('departure_time') }}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection

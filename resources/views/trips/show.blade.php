@extends('layout')

@section('content')
    <div class="container" style="padding-top: 55px;">
        <div id="show-map"></div>
        <h1>{{ $trip->title }}</h1>
        <div class="row">
            <div class="col-8">
                <div class="">
                    Driver: {{ $driver->name }}
                </div>
                <div class="">
                    Available Seats: {{ $trip->available_seats }}
                </div>
                <div class="">
                    Pickup location: {{ $trip->pickup }}
                </div>
                <div class="">
                    Dropoff location: {{ $trip->dropoff }}
                </div>
                <div class="">
                    <p>Departure Time: {{ $trip->departure_time }}</p>
                </div>
                <div class="">
                    <p>{{ $trip->description }}</p>
                </div>
            </div>
            <div class="col-4">
                <div class="">
                    <h4>Passengers:</h4>
                </div>
                @foreach ($passengers as $passenger)
                <div class="">
                    {{ $passenger->name }}
                </div>
                @endforeach
            </div>
        </div>
        @can('update', $trip)
        <a href="/trips/{{ $trip->id }}/edit"><button type="button" name="button" class="btn btn-warning" style="color:white; float:left; margin-right: 15px;">Edit</button></a>
        <form class="" action="/trips/{{ $trip->id }}" method="POST" style="float:left;">
            @method('DELETE')
            @csrf
            <button type="submit" class="btn btn-danger">Delete trip</button>
        </form>
        @endcan
        @can('add', $trip)
        <form class="" action="/trips/{{ $trip->id }}/join" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-primary">Join trip</button>
        </form>
        @endcan
        @can('leave', $trip)
        <form class="" action="/trips/{{ $trip->id }}/leave" method="POST">
            @method('PUT')
            @csrf
            <button type="submit" class="btn btn-secondary">Leave trip</button>
        </form>
        @endcan
    </div>
    <script>
    function initMap() {
        var trip = {!! json_encode($trip->toArray(), JSON_HEX_TAG) !!};
        console.log(trip.title);
        var map = new google.maps.Map(document.getElementById('show-map'), {
          zoom: 11,
          center: {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))}
        });
        var pickupMarker = new google.maps.Marker({
            position: {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))},
            map: map,
            title: "Pickup Location",
            label: "A"
        });
        var dropoffMarker = new google.maps.Marker({
            position: {lat: parseFloat(parseLatitude(trip.dropoff)), lng: parseFloat(parseLongitude(trip.dropoff))},
            map: map,
            title: "Dropoff Location",
            label: "B"
        });

        var pickupContent = '<div>Pickup Location:</div> <div>' + trip.pickup + '</div>'
        var dropoffContent = '<div>Dropoff Location</div> <div>' + trip.dropoff + '</div>'
        var pickupInfowindow = new google.maps.InfoWindow({
          content: pickupContent
        });
        var dropoffInfowindow = new google.maps.InfoWindow({
          content: dropoffContent
        });
        pickupMarker.addListener('click', function() {
          pickupInfowindow.open(map, pickupMarker);
        });
        dropoffMarker.addListener('click', function() {
          dropoffInfowindow.open(map, dropoffMarker);
        });
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfFT6ECPnarIUyb5o0gJHcrig9db8tRfQ&callback=initMap"
    async defer></script>
@endsection

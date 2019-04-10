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
        console.log(trip);

        var markers = []
        var map = new google.maps.Map(document.getElementById('show-map'), {
          zoom: 11,
          center: {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))}
        });
        // trips.forEach(function(trip){
        //     markers.push(new google.maps.Marker({
        //         position: {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))},
        //         map: map,
        //         title: trip.title
        //    }))
        // });

        // var contentString = '<div id="content">'+
        //     '<div id="siteNotice">'+
        //     '</div>'+
        //     '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
        //     '<div id="bodyContent">'+
        //     '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
        //     'sandstone rock formation in the southern part of the '+
        //     'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
        //     'south west of the nearest large town, Alice Springs; 450&#160;km '+
        //     '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
        //     'features of the Uluru - Kata Tjuta National Park. Uluru is '+
        //     'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
        //     'Aboriginal people of the area. It has many springs, waterholes, '+
        //     'rock caves and ancient paintings. Uluru is listed as a World '+
        //     'Heritage Site.</p>'+
        //     '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
        //     'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
        //     '(last visited June 22, 2009).</p>'+
        //     '</div>'+
        //     '</div>';
        //
        // var infowindow = new google.maps.InfoWindow({
        //   content: contentString
        // });



        // marker.addListener('click', function() {
        //   infowindow.open(map, marker);
        // });
    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfFT6ECPnarIUyb5o0gJHcrig9db8tRfQ&callback=initMap"
    async defer></script>
@endsection

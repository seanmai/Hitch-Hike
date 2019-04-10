@extends('layout')

@section('content')
    <div class="row">

        <div class="col-8 map-column">
            <div id="index-map"></div>
        </div>
        <div class="col-4 offset-8 display-column">
            <div class="display-header">
                Available Trips
                <a href="/trips/create"><span class="create-btn"><i class="fas fa-plus"></i></span></a>
            </div>
            <div class="display-list">
                @foreach ($trips as $trip)
                <a href="/trips/{{ $trip->id }}">
                    <div class="trip-preview">
                        <div class="trip-preview-title">
                            {{ $trip->title }}
                        </div>
                        <div class="trip-preview-seats">
                            {{ $trip->available_seats }} available seats
                        </div>
                        <div class="trip-preview-departure-time">
                            Departure Time: {{ $trip->departure_time }}
                        </div>
                        <div class="trip-preview-description">
                            {{ $trip->description }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
    <script>
    function initMap() {
        var trips = {!! json_encode($trips->toArray(), JSON_HEX_TAG) !!};

        var markers = []
        var map = new google.maps.Map(document.getElementById('index-map'), {
          zoom: 11,
          center: {lat: parseFloat(parseLatitude(trips[0].pickup)), lng: parseFloat(parseLongitude(trips[0].pickup))}
        });
        trips.forEach(function(trip){
            markers.push(new google.maps.Marker({
                position: {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))},
                map: map,
                title: trip.title
           }))
        });

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

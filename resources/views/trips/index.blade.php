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
                    <div class="trip-preview" id="trip{{ $trip->id }}" onmouseover="panMap({{ $trip }})" onmouseout="stopBounce({{ $trip }})">
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
    <script type="text/javascript">
        function parseLatitude(latlong){
            return latlong.substring(0, latlong.indexOf(','));
        }
        function parseLongitude(latlong){
            return latlong.substring(latlong.indexOf(',' ) + 1);
        }
    </script>
    <script>
    var map;
    var trips = {!! json_encode($trips->toArray(), JSON_HEX_TAG) !!};
    var markers = []
    function initMap() {
        map = new google.maps.Map(document.getElementById('index-map'), {
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
    }
    function panMap(trip){
        var center = {lat: parseFloat(parseLatitude(trip.pickup)), lng: parseFloat(parseLongitude(trip.pickup))}
        markers[trip.id-1].setAnimation(google.maps.Animation.BOUNCE);
        map.panTo(center);
    }
    function stopBounce(trip){
        markers[trip.id-1].setAnimation(null);

    }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCfFT6ECPnarIUyb5o0gJHcrig9db8tRfQ&callback=initMap"
    async defer></script>
@endsection

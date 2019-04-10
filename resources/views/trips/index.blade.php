@extends('layout')

@section('content')
    <h1>Trips</h1>
    @foreach ($trips as $trip)
        <p><a href="/trips/{{ $trip->id }}">{{ $trip->title }}</a></p>
    @endforeach
    <a href="/trips/create"><button type="button" name="button" class="btn btn-success">Create a new trip!</button></a>
    <div id="map" style="height:425px;"></div>
    <script>
    function initMap() {
        var trips = {!! json_encode($trips->toArray(), JSON_HEX_TAG) !!};

        var markers = []
        var map = new google.maps.Map(document.getElementById('map'), {
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

(function(window, google, $) {

    //var for laravel
    var latField = $('input#lat'),
        lngField = $('input#lng');

    var $maperizer = $('#map-canvas').maperizer(Maperizer.MAP_OPTIONS_ALL);

    $.ajax({
        type : "POST",
        url : window.location.href
    }).done(function(entry){

        //Set center of the map to the marker
        $maperizer.maperizer('setCenter', {
            lat:entry.lat,
            lng: entry.lng
        });

        //Add marker
        $maperizer.maperizer('addMarker', {
            lat: entry.lat,
            lng: entry.lng,
            newMarker : true
        });

    });

    $maperizer.maperizer('attachEventsToMap', [{
            name: 'click',
            callback: function(event){

                $maperizer.maperizer('removeMarkers', function(marker){
                    return marker.newMarker === true;
                });

                $maperizer.maperizer('addMarker', {
                    lat: event.latLng.lat(),
                    lng: event.latLng.lng(),
                    newMarker: true
                });

                latField.val( event.latLng.G);
                lngField.val(event.latLng.K);
            }
        }]
    );



}(window, google, jQuery));


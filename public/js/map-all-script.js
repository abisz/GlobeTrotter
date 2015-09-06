/**
 * Created by Simon on 26.08.15.
 */

(function(window, google, $) {


    var $maperizer = $('#map-canvas').maperizer(Maperizer.MAP_OPTIONS_ALL);
    var first = true;

    $.ajax({
        type:'POST',
        url:window.location.href
    }).done(function(markers){
        markers.forEach(function(marker){

            if(first){
                $maperizer.maperizer('setCenter', {
                    lat: marker.lat,
                    lng: marker.lng
                });
            }

            $maperizer.maperizer('addMarker', {
                lat: marker.lat,
                lng: marker.lng,
                content: marker.content
            });

            first = false;
        });
    });
}(window, google, jQuery));
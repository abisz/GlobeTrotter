/**
 * Created by Simon on 26.08.15.
 */


(function (window, mapster) {

    //map options
    var options = mapster.MAP_OPTIONS,
        element = document.getElementById('map-canvas'),
    //map
        map = mapster.create(element, options);

    $.ajax({
        type:'POST',
        url:window.location.href
    }).done(function(markers){
        markers.forEach(function(marker){

            map.addMarker({
                lat: marker.lat,
                lng: marker.lng,
                content: marker.content
            });

            console.log(marker);
        });
    });



}(window, window.Mapster || (window.Mapster = {})));


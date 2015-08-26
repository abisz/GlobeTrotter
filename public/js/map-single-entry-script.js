
(function (window, mapster) {

    //map options
    var options = mapster.MAP_OPTIONS,
        element = document.getElementById('map-canvas'),
    //map
        map = mapster.create(element, options);

    $.ajax({
        type : "POST",
        url : window.location.href
    }).done(function(entry){
        marker = map.addMarker({
            lat: entry.lat,
            lng: entry.lng
        });
    });

}(window, window.Mapster || (window.Mapster = {})));



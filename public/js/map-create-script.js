
(function (window, mapster) {

    //var for laravel
    var latField = $('input#lat'),
        lngField = $('input#lng');

    //map options
    var options = mapster.MAP_OPTIONS,
        element = document.getElementById('map-canvas'),
    //map
        map = mapster.create(element, options),
        attached = false,
        marker;

    map._on({
        obj: map.gMap,
        event: 'click',
        callback: function(e) {
            if (attached) {
                map._removeMarker(marker);
            }
            marker = map.addMarker({
                lat: e.latLng.G,
                lng: e.latLng.K
            });
            latField.val( e.latLng.G);
            lngField.val(e.latLng.K);

            attached = true;
            console.log('lat: '+lat+', lng: '+lng);
        }
    });


    console.log(map.markers);
}(window, window.Mapster || (window.Mapster = {})));


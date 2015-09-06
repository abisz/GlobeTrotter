
(function (window, google, $) {

    var $maperizer = $('#map-canvas').maperizer(Maperizer.MAP_OPTIONS_ZOOM);

    $.ajax({
        type: "POST",
        url: window.location.href
    }).done(function(entry){

        //set center to the entry and add marker
        $maperizer.maperizer('addFocusedMarker', {
            lat: entry.lat,
            lng: entry.lng
        });
    });


}(window, google, jQuery));



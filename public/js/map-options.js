/**
 * Created by Simon on 25.08.15.
 */

(function (window, google, mapster) {

    mapster.MAP_OPTIONS = {
        center: {
            lat: 48.213900,
            lng: 15.631896
        },
        zoom: 10,
        disableDefaultUI: true,
        scrollwheel: true,
        draggable: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    };

}(window, google, window.Mapster || (window.Mapster = {})));
(function(window, google, maperizer) {

    maperizer.MAP_OPTIONS_GEOLOCATION = {
        geolocation: true,
        center: {
            lat: 0,
            lng: 0
        },
        zoom: 7,
        searchbox: true,
        cluster: true,
        geocoder: true
    }

    maperizer.MAP_OPTIONS_ZOOM = {
        geolocation: false,
        center: {
            lat: 0,
            lng: 0
        },
        zoom: 13,
        searchbox: true,
        cluster: true,
        geocoder: true
    }

    maperizer.MAP_OPTIONS_ALL = {
        geolocation: false,
        center: {
            lat: 0,
            lng: 0
        },
        zoom: 10,
        searchbox: true,
        cluster: true,
        geocoder: true
    }


}(window, google, window.Maperizer || (window.Maperizer = {})));
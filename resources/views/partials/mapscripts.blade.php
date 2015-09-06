
@if( isset($map) )
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK6ayjkq66hjsDpFMAPfbSpgK_lc08YFo&sensor=false&signed_in=true&libraries=geometry,places"></script>
    <script src="https://google-maps-utility-library-v3.googlecode.com/svn-history/r287/trunk/markerclusterer/src/markerclusterer.js"></script>
    <script src="{{asset('js/maperizer/List.js')}}"></script>
    <script src="{{asset('js/maperizer/Maperizer.js')}}"></script>
    <script src="{{asset('js/maperizer/map-options.js')}}"></script>
    <script src="{{asset('js/maperizer/jqueryui.maperizer.js')}}"></script>

    @if($map == 'create'))
    <script src="{{asset('js/map-create-script.js')}}"></script>
    @elseif($map == 'update')
        <script src="{{asset('js/map-update-script.js')}}"></script>
    @elseif($map == 'single-entry')
        <script src="{{asset('js/map-single-entry-script.js')}}"></script>
    @elseif($map == 'single-trip')
        <script src="{{asset('js/map-all-script.js')}}"></script>
    @endif

@endif
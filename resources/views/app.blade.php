<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Globetrotter</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo asset('css/temp.css')?>"/>
</head>
<body>

<div class="container">

    @include('partials.modal')

    @include('partials.flash')

    @include('partials.header')

    @include('partials.breadcrumbs')

    @yield('content')

</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Bootstraps: Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAK6ayjkq66hjsDpFMAPfbSpgK_lc08YFo"></script>

@if( isset($map) )
    <script src="{{asset('js/Mapster.js')}}"></script>
    <script src="{{asset('js/map-options.js')}}"></script>

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


<script>
    //Slide Up Flash messages
    $('div.alert').delay(3000).slideUp();

    //Confirm deleting items
    $('.confirm').on('click', function(e){
        $('div.modal-body').text($(this).data('confirmation'));
    });
    $('#confirm-delete').on('click', function(){
        window.location.href = $('.confirm').data('path');
    });

    //add active class to breadcrumbs and remove a tag
    $('ol.breadcrumb').children().last().addClass('active');
    $('li.active a').contents().unwrap();

</script>

</body>
</html>
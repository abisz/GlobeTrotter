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

    @yield('content')

</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Bootstraps: Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

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

</script>

</body>
</html>
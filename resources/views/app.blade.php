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
    <header>
        <div class="logo">
            <img src="<?php echo url('img/logo.svg') ?>" alt="Globetrotter Logo"/>
        </div>
        <div class="user">
            @if (Auth::check())
                <p class="name">Simon Reinsperger</p>
                <img src="<?php echo url('img/profilePic.jpg') ?>" alt="profile Picture"/>
            @else
                <a href="{{ url('auth/login')  }}">Login</a>
            @endif


        </div>
    </header>

@yield('content')
</div>

</body>
</html>
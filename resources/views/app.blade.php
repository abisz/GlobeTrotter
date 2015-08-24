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
        <a href="{{url('/')}}">
            <div class="logo">
                <img src="<?php echo url('img/logo.svg') ?>" alt="Globetrotter Logo"/>
            </div>
        </a>
        <div class="user">
            @if (Auth::check())
                <a href="{{url('user')}}/{{Auth::user()->id}}/edit">
                    <p class="name">{{Auth::user()->name}}</p>
                </a>
                <a href="{{url('user')}}/{{Auth::user()->id}}">
                    <img src="{{url('img')}}/{{Auth::user()->id}}/profile-pic.jpg" alt="profile Picture"/>
                </a>
            @else
                <a href="{{ url('auth/login')  }}">Login</a>
            @endif


        </div>
    </header>

@yield('content')
</div>

</body>
</html>
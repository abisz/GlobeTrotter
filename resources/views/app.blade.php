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
                <a href="{{url('user')}}/{{Auth::user()->id}}">
                    @if (File::exists(url('img').'/'.Auth::user()->id.'/profile-pic.jpg'))
                        <img src="{{url('img')}}/{{Auth::user()->id}}/profile-pic.jpg" alt="profile Picture"/>
                    @else
                        <img src="{{url('img')}}/profile-pic.jpg" alt="profile Picture"/>
                    @endif
                </a>

                <div class="dropdown">
                    <a id="dLabel"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{Auth::user()->name}}
                        <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dLabel">
                        <li><a href="{{url('user')}}/{{Auth::user()->id}}">My Trips</a></li>
                        <li><a href="{{url('user')}}/{{Auth::user()->id}}/edit">Edit Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{url('auth/logout')}}">Logout</a></li>
                    </ul>
                </div>


            @else
                <a class="btn btn-default" href="{{ url('auth/login')  }}">Login</a>
                <a class="btn btn-primary" href="{{ url('auth/register')  }}">Register</a>

            @endif


        </div>
    </header>

@yield('content')
</div>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<!-- Bootstraps: Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>



</body>
</html>
<header>
    <a href="{{url('/')}}">
        <div class="logo">
            <img src="<?php echo url('img/logo.svg') ?>" alt="Globetrotter Logo"/>
        </div>
    </a>
    <div class="user">
        @if (Auth::check())
            <a href="{{url('user')}}/{{Auth::user()->id}}">
                @if (File::exists('img/'.Auth::user()->id.'/profile-pic.jpg'))
                    <img src="{{url('img')}}/{{Auth::user()->id}}/profile-pic.jpg" alt="profile Picture"/>
                @else
                    <img src="{{url('img')}}/profile-pic-default.jpg" alt="profile Picture"/>
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
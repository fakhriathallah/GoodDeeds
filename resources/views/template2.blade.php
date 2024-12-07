<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Good Deeds</title>
    <link rel="stylesheet" href="{{ asset('css/template.css') }}">
</head>
<body>
    <header>
        <div class="logo">
            <img src="{{ asset('assets/logo.jpg') }}" alt="Logo">
        </div>
        <nav>
            <a href="{{ route('home.index') }}">Home</a>

            <!-- Sections toggled dynamically -->
            @auth
                <div>
                    <a href="{{ route('mydeed.index')}}">Your Deeds</a>
                    <a href="{{ route('activity.index')}}">Activity</a>
                    <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                Log Out
                            </a>
                    </form>
                    <!-- <a id="logout-btn" href="#" onclick="logoutUser()">Sign Out</a> -->
                </div>
            @endauth
            @guest
                <div>
                    <a href="{{ route('register') }}">Sign Up</a>
                    <a href="{{ route('login') }}">Sign In</a>
                </div>
            @endguest
        </nav>
    </header>
    <div class="content">
        <div class="col">@yield('content')</div>
    </div>
</body>
</html>

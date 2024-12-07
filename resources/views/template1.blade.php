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
            <div id="logged-in" style="display: none; gap: 25px; margin-right: 20px">
                <a href="{{ route('mydeed.index')}}">Your Deeds</a>
                <a href="{{ route('activity.index')}}">Activity</a>
                <a href="#">Profile</a>
                <!-- <a id="logout-btn" href="#" onclick="logoutUser()">Sign Out</a> -->
            </div>
            @endauth
            <div id="not-logged-in" style="display: none; gap: 25px; margin-right: 20px">
                <a href="{{ route('register') }}">Sign Up</a>
                <a href="{{ route('login') }}">Sign In</a>
            </div>
        </nav>
    </header>
    <div class="content">
        <div class="col">@yield('content')</div>
    </div>
    <footer>
        <div class="col text-center">&copy;2024 Good Deeds</div>
    </footer>

    <script>
        window.onload = function() {
            @if (session('userId') && session('username'))
                // Store user info in localStorage
                localStorage.setItem('userId', '{{ session('userId') }}');
                localStorage.setItem('username', '{{ session('username') }}');
            @endif

            // Check if user is logged in (by checking localStorage)
            const userId = localStorage.getItem('userId');
            const username = localStorage.getItem('username');

            if (userId && username) {
                // Show logged-in header elements
                document.getElementById('logged-in').style.display = 'flex';
                document.getElementById('not-logged-in').style.display = 'none';
            } else {
                // Show not-logged-in header elements
                document.getElementById('logged-in').style.display = 'none';
                document.getElementById('not-logged-in').style.display = 'flex';
            }
        };

        function logoutUser() {
            // Clear session data from the server side
            fetch('/logout', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'  // Include CSRF token for security
                }
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);  // Logged out message from server

                // Clear localStorage
                localStorage.removeItem('userId');
                localStorage.removeItem('username');

                // Verify that localStorage is cleared
                console.log(localStorage.getItem('userId'));  // Should log null
                console.log(localStorage.getItem('username')); // Should log null

                // Redirect to homepage after logout
                window.location.href = '/';  // Or redirect to login page: window.location.href = '/login';
            })
            .catch(error => {
                console.error('Error logging out:', error);
            });
        }
    </script>
</body>
</html>

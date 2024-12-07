@extends('template')
@section('content')
<div class="profile" style="display: flex; flex-direction: column; gap: 20px; padding: 20px; max-width: 600px; margin: 40px auto;">
    <div class="field-container" style="display: flex; flex-direction: column; position: relative;">
        <label style="position: absolute; top: -10px; left: 10px; font-size: 1.2rem; color: #555; background-color: #f9f9f9; padding: 0 5px;">Username</label>
        <div style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h1 style="margin: 0; font-size: 1.5rem; color: #333;">{{ $user->username }}</h1>
        </div>
    </div>

    <div class="field-container" style="display: flex; flex-direction: column; position: relative;">
        <label style="position: absolute; top: -10px; left: 10px; font-size: 1.2rem; color: #555; background-color: #f9f9f9; padding: 0 5px;">Email</label>
        <div style="border: 1px solid #ddd; border-radius: 10px; padding: 15px; background-color: #fff; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
            <h1 style="margin: 0; font-size: 1.5rem; color: #333;">{{ $user->email }}</h1>
        </div>
    </div>
    <button style="width: 50%; align-self:center; height:3vh; border-radius:10px; background-color:#64C3BF" onclick="logoutUser()">Sign Out</button>
</div>
<script>
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
@endsection

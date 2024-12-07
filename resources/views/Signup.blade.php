@extends('template')
@section('content')
<div class="signup-content">
    <h1 id="Create">Create Account</h1>
    <form action="{{ route('signup.store') }}" method="POST">
        @csrf
        <div class="inputFields">
            <input id="usernameInput" type="text" name="username" placeholder="Username" value="{{ old('username') }}" required>
            <input id="emailInput" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
            <input id="passInput" type="password" name="password" placeholder="Password" required>
            <input id="confirmPassInput" type="password" name="password_confirmation" placeholder="Confirm Password" required>
            <button id="submit" type="submit">Sign Up</button>
        </div>
        @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="TermsText">
            <h4 id="text1">By continuing you are agreeing to our <a id="alink" href="#">terms & conditions</a> and our privacy policies.</h4>
            <h4 id="text2">Already have an account? <a id="alink" href="./LoginMenu.html" rel="noopener noreferrer">Log in</a></h4>
        </div>
    </form>
</div>
@endsection

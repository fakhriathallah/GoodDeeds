@extends('template')
@section('content')
<div class="signin-input">
    <form action="{{ route('signin.logic') }}" method="POST" id="loginForm">
        @csrf
        <h1 id="welcome">Welcome Back!</h1>
        <h2 id="feelGood">Login</h2>
        <input id="emailInput" type="text" name="email" placeholder="Email">
        <input id="passInput" type="password" name="password" placeholder="Password">
        <div id="botBox">
            <input type="checkbox" name="remember" id="remember">
            <h4 id="rememberText">Remember Me</h4>
            <a id="forgot" href="#" target="_blank" rel="noopener noreferrer">Forget Password?</a>
        </div>
        <button type="submit" id="loginButton">Login</button>
        <h4 id="text1">By continuing you are agreeing to our <a id="alink" href="#" rel="noopener noreferrer">terms & conditions</a> and our privacy policies</h4>
        <h4 id="text2">Don’t Have an Account? <a id="alink" href="{{ route('signup.index') }}" rel="noopener noreferrer">Sign Up</a></h4>
    </form>
</div>
@endsection

@extends('template')
@section('content')
<div class="welcome-container" style="display: flex; justify-content: center; align-items: center; height: 50vh; padding: 20px; box-sizing: border-box;">
    <div class="welcome-text" style="max-width: 800px; background: #fff; border-radius: 15px; padding: 30px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <h2 style="font-family: 'Arial', sans-serif; font-size: 1.8rem; line-height: 1.6; color: #333; text-align: center; margin-bottom: 20px;">
            Welcome to <span style="color: #007bff; font-weight: bold;">Good-Deeds!</span>
        </h2>
        <p style="font-family: 'Arial', serif; font-size: 1rem; line-height: 1.8; color: #555; text-align: justify; margin-bottom: 0;">
            We're a community-driven platform connecting people with tasks or creative commissions to talented individuals ready to help. Whether you’re looking for professional assistance at a fair price or hoping to find someone willing to volunteer their time and skills, we make collaboration easy and rewarding.
        </p>
        <p style="font-family: 'Arial', serif; font-size: 1rem; line-height: 1.8; color: #555; text-align: justify; margin-top: 15px;">
            Join us to turn ideas into reality, one connection at a time!
        </p>
    </div>
</div>
@endsection

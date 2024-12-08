@extends('template-profile')
@section('content-profile')
<div class="main-content bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
        <div class="page-header min-height-200 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
          <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        
    </div>
    <div class="container-fluid py-4">
        <div class="card card-body blur shadow-blur mx-4 mt-n7 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                    <h5 class="mb-1">
                        {{Auth::user()->name}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        @if (Auth::user()->type == 1)
                            Owner
                        @elseif(Auth::user()->type == 2)
                            Taker
                        @endif
                    </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-body blur shadow-blur mx-4 my-2 overflow-hidden">
            <div class="row gx-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="card card-body blur shadow-blur mx-4 my-2 overflow-hidden">
            <div class="row gx-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="card card-body blur shadow-blur mx-4 my-2 overflow-hidden">
            <div class="row gx-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
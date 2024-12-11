@extends('template')
@section('content')
<div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <div class="container-fluid">
        <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
            <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto my-auto">
            <div class="h-200">
                <h1>{{ $deed->title }}</h1>
              <p class="mb-0 font-weight-bold text-sm">
              Commissioned by : {{ $deed->owner->name }}
              </p>
            </div>
          </div>
        </div>
        <div class="row gx-4">
          <div class="col-auto mt-8 mb-auto">
            @if (Auth::user()->id != $deed->owner_user_id)
                @if(Auth::user()->type == 2)
                    @if ($deed->taker_user_id == 0)
                        <form action="{{ route('deed.take', ['id'=>$deed->id]) }}" method="POST">
                            @csrf

                            <input type="hidden" name="deed_id" value="{{ $deed->id }}">

                            <button type="submit" class="btn btn-primary">Take Job</button>
                        </form>
                    @else
                        <p id="job-status" style="font-weight: bold; color: green;">
                            This deed has already been taken.
                        </p>
                @endif
                @elseif(Auth::user()->type == 1)
                    <button type="submit" class="btn btn-primary">Login As Owner</button>
                @endif
            @else
                @if ($deed->taker_user_id == 0)
                    <a type="button" class="btn btn-primary" href="{{ route('deed.updateDetail', ['deed'=>$deed->id]) }}">UPDATE JOB</a>
                    {{-- <a type="button" class="btn btn-primary" href="{{ route('deed.delete', ['deed'=>$deed->id]) }}">DELETE JOB</a> --}}
                    <form action="{{ route('deed.delete', ['deed'=>$deed->id]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="delete" class="btn btn-danger">
                    </form>
                @endif
            @endif
          </div>
        </div>
      </div>
    <div class="deeds-detail">
        <p>Description: </p>
        <p>{{ $deed->description }}</p>
        <p>Reward: {{ $deed->prize }}</p>
        @if (session('userId') == $deed->owner_user_id && $deed->taker_user_id != 0)
            <p style="margin-top: 10vh; color:aquamarine">This deed is currently being handled by {{$deed->taker->username}}</p>
        @endif
    </div>

    {{-- <p>Halo {{Auth::user()->id}}</p> --}}
    </div>
</div>
<script>
    function takeJob(deedId) {
        fetch(`/take-deed/${deedId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const button = document.getElementById('take-job-btn');
            if (data.success) {
                // Change the button to a success message
                button.outerHTML = `<p id="job-status" style="font-weight: bold; color: green; display: flex; justify-content: center; align-items: center;">Successfully taken the deed</p>`;
            } else if (data.error) {
                // Display error message
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    // function deleteJob(deedId) {
    //     if (confirm('Are you sure you want to delete this job?')) {
    //         fetch(`/deeds/${deedId}`, {
    //             method: 'DELETE',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             }
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             if (data.success) {
    //                 alert(data.message);
    //                 window.location.href = '{{ route('home.index') }}';
    //             } else {
    //                 alert(data.message);
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             alert('An error occurred while deleting the job.');
    //         });
    //     }
    // }
</script>
@endsection

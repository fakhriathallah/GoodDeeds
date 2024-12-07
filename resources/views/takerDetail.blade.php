@extends('template')
@section('content')
<h1 class="title">Deeds Details</h1>
<div class="deeds-detail">
    <h1>{{ $deed->title }}</h1>
    <p>Commissioned by: {{ $deed->owner->name }}</p>
    <p>Location: </p>
    <p>{{ $deed->description }}</p>
    <p>Reward: {{ $deed->prize }}</p>
    @if (session('userId') == $deed->owner_user_id && $deed->taker_user_id != 0)
        <p style="margin-top: 10vh; color:aquamarine">This deed is currently being handled by {{$deed->taker->username}}</p>
    @endif
</div>

@if (session('userId') != $deed->owner_user_id)
    @if ($deed->taker_user_id == 0)
        <button id="take-job-btn" onclick="takeJob({{ $deed->id }})">
            TAKE JOB
        </button>
    @else
        <p id="job-status" style="font-weight: bold; color: green;">
            This deed has already been taken.
        </p>
    @endif
@else
    @if ($deed->taker_user_id == 0)
        <button id="delete-job-btn" onclick="deleteJob({{ $deed->id }})">
            DELETE JOB
        </button>
    @endif
@endif

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

    function deleteJob(deedId) {
        if (confirm('Are you sure you want to delete this job?')) {
            fetch(`/deeds/${deedId}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert(data.message);
                    window.location.href = '{{ route('home.index') }}';
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the job.');
            });
        }
    }
</script>
@endsection

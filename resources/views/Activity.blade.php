@extends('template')
@section('content')
<h1 class="title">Here are your accepted deeds...</h1>
<div class="activity">
    @foreach ($deeds as $deed)
        <div class="feed">
            <div class="deeds">
                <h1>{{$deed->title}}</h1>
                <h2>Prize : {{$deed->prize}}</h2>
                <h2>Status : {{$deed->status}}</h2>
            </div>
            @if ($deed->status == 'Taken')
                <div class="status" style="align-items: center; justify-content:center">
                    <button id="cancel-job-btn" onclick="cancelJob({{ $deed->id }})" style="width: 15vh; height:3vh; margin-top:2vh">
                        Cancel
                    </button>
                    <button id="complete-job-btn" onclick="completeJob({{ $deed->id }})" style="width: 15vh; height:3vh; margin-top:2vh">
                        Complete
                    </button>
                </div>
            @endif
        </div>
    @endforeach
    <div class="pagination">
        {{ $deeds->links('pagination.custom') }}
    </div>
</div>
<script>
    function cancelJob(deedId) {
        fetch(`/cancel-deed/${deedId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const button = document.getElementById('cancel-job-btn');
            if (data.success) {
                // Change the button to a success message
                window.location.reload();
            } else if (data.error) {
                // Display error message
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }

    function completeJob(deedId) {
        fetch(`/complete-deed/${deedId}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            const button = document.getElementById('complete-job-btn');
            if (data.success) {
                // Change the button to a success message
                window.location.reload();
            } else if (data.error) {
                // Display error message
                alert(data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>
@endsection


@extends('template')
@section('content')
<div class="container">
    <!-- Right Div (50%) -->
    <div class="right">
        <div class="right-content">
            @auth
                <p>{{Auth::user()->name}}</p>
            @endauth
            @foreach ($deeds as $deed)
                <div class="feed">
                    <div class="deeds">
                        <h1>{{$deed->title}}</h1>
                        <h2>Requested by : {{$deed->owner->username}}</h2>
                        <h2>Prize : {{$deed->prize}}</h2>
                    </div>
                    <div class="details">
                        <a class="details-text" href="{{ route('deedDetailTaker', ['deed'=>$deed->id]) }}">Details</a>
                    </div>
                </div>
            @endforeach
            <!-- pagination button -->
            <div class="pagination">
                {{ $deeds->links('pagination.custom') }}
            </div>
        </div>
    </div>
</div>
<script>
    function addDeeds(){
        @if (session('userId') && session('username'))
            window.location.href = "{{ route('adddeed.index') }}";
        @else
            window.location.href = "{{ route('login') }}";
        @endif
    }
</script>
@endsection

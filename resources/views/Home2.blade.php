@extends('template')
@section('content')
<div class="container">
    <!-- Left Div (50%) -->
    <div class="left">
        <button onclick="addDeeds()">
            <h1>NEED</h1>
            <H1>HELP?</H1>
        </button>
    </div>

    <!-- Right Div (50%) -->
    <div class="right">
        <div class="right-content">
            @foreach ($deeds as $deed)
                <div class="feed">
                    <div class="deeds">
                        <h1>{{$deed->title}}</h1>
                        <h2>Requested by : {{$deed->owner->name}}</h2>
                        <h2>Prize : {{$deed->prize}}</h2>
                    </div>
                    <div class="details">
                        <a class="details-text" href="{{ route('deed.detail', ['deed'=>$deed->id]) }}">Details</a>
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
            window.location.href = "{{ route('login') }}";
        @else
            window.location.href = "{{ route('register') }}";
        @endif
    }
</script>
@endsection

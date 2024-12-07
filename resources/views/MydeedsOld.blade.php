@extends('template')
@section('content')
<div class="my-deeds">
    <h1 class="title">Need Help? Add Deeds Here...</h1>
    <div class="add-button" onclick="addDeeds()">
        <button>Add Deeds</button>
    </div>
    @foreach ($deeds as $deed)
        <div class="feed">
            <div class="deeds">
                <h1>{{$deed->title}}</h1>
                <h2>Prize : {{$deed->prize}}</h2>
            </div>
            <div class="details">
                <a href="{{ route('deed.detail', ['deed'=>$deed->id]) }}">Details</a>
            </div>
        </div>
    @endforeach
    <div class="pagination">
        {{ $deeds->links('pagination.custom') }}
    </div>
</div>
<script>
    function addDeeds(){
        @if (session('userId') && session('username'))
            window.location.href = "{{ route('adddeed.index') }}";
        @else
            window.location.href = "{{ route('signin.index') }}";
        @endif
    }
</script>
@endsection

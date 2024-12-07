@extends('template')
@section('content')
@if ($errors->any())
    <div class="alert alert-danger" style="color: red; margin-bottom: 15px;">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('adddeed.store') }}" method="POST" style="display: flex; flex-direction: column;">
    @csrf
    <input id="titleInput" type="text" name="title" placeholder="Title" style="width: 100vh; border-radius:20px; padding-left:10px; height:5vh">
    <input id="descriptionInput" type="text" name="description" placeholder="Description" style="height: 10vh; margin-top:2vh; border-radius:20px; padding-left:10px">
    <input id="prizeInput" type="number" name="prize" placeholder="Prize" style="height: 5vh; margin-top:2vh; border-radius:20px; padding-left:10px">
    <button id="submit" type="submit" style="margin-top: 2vh; border-radius:20px; padding: 10px;">Submit</button>
</form>
@endsection

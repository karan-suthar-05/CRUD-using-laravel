@extends('layouts.main')
@section('main-section')

<div class="container m-5">
    @if(session("success"))
        <div class="alert alert-success" role="alert">
        {{session("success")}}       
      </div>
    @endif
    <h1 class="p-auto">Welcome to My Notes App</h1>
    <h3><a href="{{ route('note') }}">Go to your notes</a></h3>
</div>

@endsection
@extends('layouts.main')
@section('main-section')

<div class="container mx-auto my-5">
  <h2>Sign In</h2>
  <form action="{{ route('note.userlogin') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="uname" class="form-label">User name</label>
      <input type="text" class="form-control" id="uname" name="uname" value="{{old('uname')}}" placeholder="Enter user name">
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Password</label>
      <input type="password" class="form-control" id="pass" name="pass" placeholder="Enter Password">
    </div>
    @error('uname')
    <div class="alert alert-danger" role="alert">
      {{$message}}       
    </div>
    @enderror
    @error('pass')
    <div class="alert alert-danger" role="alert">
      {{$message}}       
    </div>
    @enderror
    <input type="submit" class="btn btn-primary" value="Sign in">
  </form>
</div>

@endsection

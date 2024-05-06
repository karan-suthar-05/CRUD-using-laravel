@extends('layouts.main')
@section('main-section')

<div class="container mx-auto my-5">
  <h2>Sign Up</h2>
  <form action="{{ route('note.register') }}" method="POST">
    @csrf
    <div class="mb-3">
      <label for="uname" class="form-label">User name</label>
      <input type="text" class="form-control" id="uname" name="uname" value="{{old('uname')}}" placeholder="Enter user name">
    </div>
    <div class="mb-3">
      <label for="pass" class="form-label">Password</label>
      <input type="password" class="form-control" id="pass"  name="pass"  placeholder="Enter Password">
    </div>
    <div class="mb-3">
      <label for="cpass" class="form-label">Confirm password</label>
      <input type="password" class="form-control" id="cpass" name="cpass"  placeholder="Enter confirm passwrod">
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
    @error('cpass')
    <div class="alert alert-danger" role="alert">
      {{$message}}       
    </div>
    @enderror
                      
            
    <input type="submit" class="btn btn-primary" value="Sign up">
  </form>
</div>

@endsection

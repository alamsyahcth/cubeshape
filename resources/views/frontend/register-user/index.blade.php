@extends('frontend/layouts/app')
@section('title', 'Entry PIN')

@section('content')
<div class="container h-100-vh">
  <div class="row justify-content-center h-100">
    <div class="col-md-5 my-auto">
      <div class="my-5 text-center">
        <img src="{{ asset('img/logo-01.svg') }}" width="100" alt="">
        <h3>Cubeshape</h3>
      </div>
      <div class="card">
        <div class="card-body border-0">
          <form action="{{ url('enter-pin') }}" method="POST">
            @csrf
            <input type="text" class="form-control text-center input-quiz text-primary @error('pin') is-invalid @enderror @if($error = Session::get('error')) is-invalid @endif" name="pin" id="pin" maxlength="5" placeholder="Game Pin">
            @error('pin') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
              </span> 
						@enderror
            @if($error = Session::get('error'))
              <span class="text-error">
								<strong>{{ $error}}</strong>
              </span> 
            @endif
            <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Enter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
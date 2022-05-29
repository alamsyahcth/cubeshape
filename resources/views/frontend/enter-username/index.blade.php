@extends('frontend/layouts/app')
@section('title', 'Entry Username')

@section('content')
@if(Session::get('quizId') != null)
  @php 
    $roomName = Session::get('quizName')
  @endphp
@else
  @php 
    $roomName = 'Our Quiz'
  @endphp
@endif
<div class="container h-100">
  <div class="row justify-content-center h-100">
    <div class="col-md-5 my-auto">
      <div class="my-5 text-center">
        <img src="{{ asset('img/logo-01.svg') }}" width="100" alt="">
        <h3>Cubeshape</h3>
      </div>
      <div class="card">
        <div class="card-body border-0">
          <div class="my-4">
            <h3>Hi, welcome to the <span class="text-primary">{{ $roomName }}</span></h3>
            <p>please enter your personal data before starting the quiz</p>
          </div>
          <form action="{{ url('register-player') }}" method="POST" novalidate>
            @csrf

            <input type="text" class="form-control text-center input-quiz text-primary my-2 @error('name') is-invalid @enderror" name="name" id="name" placeholder="Enter name">
            @error('name') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
              </span> 
						@enderror

            <input type="email" class="form-control text-center input-quiz text-primary my-2 @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter email">
            @error('email') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
              </span> 
						@enderror

            <input type="text" class="form-control text-center input-quiz text-primary my-2 @error('phoneNumber') is-invalid @enderror" name="phoneNumber" id="phoneNumber" maxlength="14" placeholder="Enter Phone Number">
            @error('phoneNumber') 
							<span class="invalid-feedback" role="alert">
								<strong>{{ $message }}</strong>
              </span> 
						@enderror
            
            <button type="submit" class="btn btn-primary btn-block btn-lg mt-3">Enter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
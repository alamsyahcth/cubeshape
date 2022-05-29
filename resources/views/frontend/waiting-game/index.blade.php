@extends('frontend/layouts/app')
@section('title', 'Waiting ...')

@section('content')
<div class="container h-100-vh">
  <div class="row justify-content-center h-100">
    <div class="col-md-4 my-auto">
      <div class="text-center">
        <img src="{{ asset('img/logo-01.svg') }}" width="70" alt="">
        <img src="{{ asset('img/waiting.svg') }}" class="img-fluid" alt="">
        @if($data->status <= 2)
          <h3 class="text-primary mt-5">
            Waiting <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
          </h3>
          <h6 class="mt-2">Wait for the host to start the quiz</h6>
        @elseif($data->status == 3)
          <a href="{{ url('/quiz') }}" class="btn btn-primary btn-lg mt-5">
            Start Quiz
          </a>
          <h6 class="mt-2">Please click start to start the quiz, and get the best results</h6>
        @else
          <h3 class="text-danger mt-5">
            Something wrong, please contact Admin
          </h3>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
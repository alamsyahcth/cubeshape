@extends('frontend/layouts/app')
@section('title', 'Result')

@section('content')
<div class="container h-90-vh">
  <div class="row h-100 justify-content-center">
    <div class="col-md-8 my-auto text-center">
      <img src="{{ asset('img/success.svg') }}" class="img-fluid w-50 mb-4" alt="">
      <h3 class="mb-3">Congratulations You Have Completed This Quiz, <span class="text-dark">Here Are Your Scores !</span></h3>
      <h1 class="score"><span class="text-primary">{{ $data->score }}</span> from <span class="text-primary">{{ $quiz }}</span> Question</span></h1>
      <a href="/" class="btn btn-primary btn-lg mt-4">Finish</a>
    </div>
  </div>
</div>
@endsection
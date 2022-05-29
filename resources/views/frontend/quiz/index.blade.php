@extends('frontend/layouts/app')
@section('title', 'Quiz')

@section('content')
<div class="container h-90-vh w-100">
  <div class="row justify-content-center mb-5">
    <div class="col-md-5 position-relative">
      <div class="position-absolute mx-auto left-0 right-0">
        <h2 class="bg-pink p-3 rounded text-primary text-center" id="time">00.00</h2>
      </div>
    </div>
  </div>
  @for($i = 1; $i < 10; $i++)
  <div class="row h-100 step @if($i == 1) active @endif step-{{ $i }}">
    <div class="col-md-2 my-auto">
      <button class="btn btn-pink prev" disabled>
        <i class="fas fa-arrow-left"></i>
        Prev
      </button>
    </div>
    <div class="col-md-8 my-auto text-center">
      <h5 class="text-secondary">Question <span class="activeIndex"></span> / <span class="countIndex"></span></h5>
      <h1>Siapakah Penemu Lampu Pijar ? {{ $i }}</h1>
    </div>
    <div class="col-md-2 my-auto text-end">
      <button class="btn btn-pink next">
        Next
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    <div class="col-md-6 p-2">
      <button class="btn btn-option-1 btn-lg btn-block h-100 next">
        A. Thomas Alva Edison {{ $i }}
      </button>
    </div>
    <div class="col-md-6 p-2">
      <button class="btn btn-option-2 btn-lg btn-block h-100 next">
        B. Thomas Michael {{ $i }}
      </button>
    </div>
    <div class="col-md-6 p-2">
      <button class="btn btn-option-3 btn-lg btn-block h-100 next">
        C. Thomas Steven {{ $i }}
      </button>
    </div>
    <div class="col-md-6 p-2">
      <button class="btn btn-option-4 btn-lg btn-block h-100 next">
        B. Thomas Si Pelaut {{ $i }}
      </button>
    </div>
  </div>
  @endfor
</div>
@endsection
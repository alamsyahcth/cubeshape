@extends('backend/layouts/app')
@section('title')
  Create New {{ ucfirst($page) }}
@endsection

@section('content-header-right')

@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 px-0">
      <div class="card">
        <div class="card-body">
          <form action="{{ url('admin/'.$page.'/create') }}" method="post" novalidate>
            @csrf

            <div class="form-group">
              <label for="">Quiz Name</label>
              <input type="text" name="quizName" class="form-control @error('quizName') is-invalid @enderror" placeholder="Input Quiz Name">
              @error('quizName')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> 
              @enderror
            </div>
            <div class="form-group">
              <label for="">Description</label>
              <textarea type="textarea" name="quizDescription" class="form-control @error('quizDescription') is-invalid @enderror" rows="8" placeholder="Input Quiz Description"></textarea>
              @error('quizDescription')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> 
              @enderror
            </div>
            <div class="form-group">
              <label for="">Quiz Time</label>
              <div class="row">
                <div class="col-md-4">
                  <div class="input-group mb-3">
                    <input type="number" name="quizTimeMinute" class="form-control @error('quizTimeMinute') is-invalid @enderror" placeholder="Input Quiz Minute" aria-describedby="labelMinute">
                    <div class="input-group-append">
                      <span class="input-group-text" id="labelMinute">Minute</span>
                    </div>
                  </div>
                   @error('quizTimeMinute')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span> 
                  @enderror
                </div>
                <div class="col-md-4">
                  <div class="input-group mb-3">
                    <input type="number" name="quizTimeSecond" class="form-control @error('quizTimeSecond') is-invalid @enderror" placeholder="Input Quiz Second" aria-describedby="labelSecond">
                    <div class="input-group-append">
                      <span class="input-group-text" id="labelSecond">Second</span>
                    </div>
                  </div>
                   @error('quizTimeSecond')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span> 
                  @enderror
                </div>
              </div>
            </div>
            <div class="form-group d-flex justify-content-end">
              <button class="btn btn-primary">Save</button>
            </div>
            
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
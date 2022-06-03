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
  @foreach($getQuestion as $questions => $q)
  <div class="row h-100 justify-content-center step step-{{ $questions + 1 }}">
    <div class="col-md-2 my-auto">
      <button class="btn btn-pink prev" disabled>
        <i class="fas fa-arrow-left"></i>
        Prev
      </button>
    </div>
    <div class="col-md-8 my-auto text-center">
      <h5 class="text-secondary">Question <span class="activeIndex"></span> / <span class="countIndex"></span></h5>
      <h1>{{ $q->title }}</h1>
    </div>
    <div class="col-md-2 my-auto text-end">
      <button class="btn btn-pink next">
        Next
        <i class="fas fa-arrow-right"></i>
      </button>
    </div>
    @foreach($getQuestionOption as $questionOption => $o)
      @if($q->id == $o->question_id)
        <div class="col-md-6 p-2">
          <div class="btn btn-option btn-option-1 btn-lg btn-block">
            <input type="radio" name="option-{{ $questions }}" id="option-{{ $questions }}-{{ $questionOption }}" class="input-quiz-value" value="{{ $o->is_true }}">
            <label for="option-{{ $questions }}-{{ $questionOption }}" class="my-auto next">{{ $o->option }}</label>
          </div>
        </div>
      @endif
    @endforeach
  </div>
  @endforeach
</div>
<input type="hidden" id="limitTime" value="{{ $show }}">
@endsection

@push('popup')
<div class="modal fade" id="quizSubmit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close-modal close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h2>Are you sure you want to submit your answer?</h2>
        <p>You will get a score after submitting your answer</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger close-modal">No</button>
        <button type="button" class="btn btn-primary" id="submitQuiz">Yes</button>
      </div>
    </div>
  </div>
</div>
@endpush
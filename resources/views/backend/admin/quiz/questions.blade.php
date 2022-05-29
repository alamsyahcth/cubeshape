@extends('backend/layouts/app')
@section('title')
  Manage {{ ucfirst($page) }} {{ ucfirst($secondPage) }} 
@endsection

@section('content-header-right')
  <a href="javascript:void(0)" class="btn btn-success" data-toggle="modal" data-target="#createQuestionOption">Create {{ ucfirst($secondPage) }}</a>
@endsection

@section('content-header-left')
  <a href="{{ url('admin/'.$page.'/all') }}" class="btn btn-round"><i class="fas fa-arrow-left"></i></a>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 px-0">
      <div class="card">
        <div class="card-body">
          <table class="table dataTable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="50%">Questions</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($questions as $datas => $d)
              <tr>
                <td>{{ $datas + 1 }}</td>
                <td>{{ $d->title }}</td>
                <td>
                  <div class="mb-2 d-flex justify-content-start">
                    @if($d->status == 1) 
                      <div class="badge badge-sm badge-success">Active</div>
                    @elseif($d->status == 2) 
                      <div class="badge badge-sm badge-danger">Not Active</div>
                    @endif
                  </div>
                </td>
                <td>
                  <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm edit-question"
                    data-id="{{ $d->id }}"
                    data-quizId="{{ $d->quiz_id }}"
                    data-title="{{ $d->title }}"
                  ><i class="fas fa-edit"></i></a>
                  <a href="{{ url('admin/'.$page.'/'.$secondPage.'/delete/'.$d->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('popup')
<div class="modal fade" id="createQuestionOption" tabindex="-1" aria-labelledby="createQuestionOptionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createQuestionOptionLabel">Create</h5>
      </div>
      <form action="{{ url('admin/'.$page.'/'.$secondPage.'/create') }}" method="post" novalidate>
        @csrf

        <div class="modal-body">
          <input type="hidden" name="quizId" value="{{ $data->id }}">
          <div class="row align-items-center">
            <div class="col-12 mb-3">
              <label for="">Your Question</label>
              <textarea type="textarea" name="questionTitle" class="form-control @error('questionTitle') is-invalid @enderror" rows="4" placeholder="input your question"></textarea>
            </div>
            <div class="col-9 font-weight-bold mb-3">Options</div>
            <div class="col-3 font-weight-bold mb-3">True Answer</div>
            @php $j = 1; @endphp
            @for($i = 0; $i < 4; $i++)
              <div class="col-10">
                <input type="text" name="option[]" class="form-control mb-2" placeholder="Input question {{ $j++ }}" required>
              </div>
              <div class="col-2 px-0 text-center">
                <label for="" class="option-label"><input type="checkbox" name="choose" class="option form-check-input" id="choose-{{ $i }}" value="" @if($i == 0) checked @endif /></label>
                <input type="hidden" name="answer[]" value="@if($i == 0) 1 @else 0 @endif" id="option-{{ $i }}" class="option-question">
              </div>
            @endfor
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>

<div class="modal modalUpdate fade" id="updateQuestionOption" tabindex="-1" aria-labelledby="updateQuestionOptionLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateQuestionOptionLabel">Update</h5>
      </div>
      <form action="{{ url('admin/'.$page.'/'.$secondPage.'/update') }}" method="post" novalidate>
        @csrf

        <div class="modal-body">
          <input type="hidden" name="questionId" class="questionId">
          <input type="hidden" name="quizId" class="quizId">
          <div class="row align-items-center">
            <div class="col-12 mb-3">
              <label for="">Your Question</label>
              <textarea type="textarea" name="questionTitle" class="form-control questionTitle @error('questionTitle') is-invalid @enderror" rows="4" placeholder="input your question"></textarea>
            </div>
            <div class="col-9 font-weight-bold mb-3">Options</div>
            <div class="col-3 font-weight-bold mb-3">True Answer</div>
            @php $j = 1; @endphp
            @for($i = 0; $i < 4; $i++)
              <input type="hidden" name="optionId[]" class="questionId-{{ $i }}">
              <div class="col-10">
                <input type="text" name="option[]" class="form-control mb-2 questionOption-{{ $i }}"  placeholder="Input question {{ $j++ }}" required>
              </div>
              <div class="col-2 px-0 text-center">
                <label for="" class="option-label"><input type="checkbox" name="choose" class="option-update form-check-input" id="choose-update-{{ $i }}" value="" /></label>
                <input type="hidden" name="answer[]" id="option-update-{{ $i }}" class="option-update-question questionAnswer-{{ $i }}">
              </div>
            @endfor
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
@endpush
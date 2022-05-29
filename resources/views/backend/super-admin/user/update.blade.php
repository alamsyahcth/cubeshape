@extends('backend/layouts/app')
@section('title')
  Update {{ ucfirst($page) }}
@endsection

@section('content-header-right')

@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 px-0">
      <div class="card">
        <form action="{{ url('super-admin/'.$page.'/update/'.$data->id) }}" method="post" novalidate>
          @csrf
          <div class="card-body">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control @error('name') is-ivalid @enderror" name="name" value="{{ $data->name }}" placeholder="Name">
              @error('name')
                <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span> 
              @enderror
            </div>
            <div class="form-group">
              <label for="status">Status</label>
              <select name="status" class="form-control">
                <option value="1" @if($data->status_id == 1) selected @endif>Active</option>
                <option value="2" @if($data->status_id == 2) selected @endif>Not Active</option>
              </select>
            </div>
          </div>
          <div class="card-footer">
            <div class="row">
              <div class="col-md-12 text-end justify-content-end">
                <button type="submit" class="btn btn-primary">
                  Save
                </button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('backend/layouts/app')
@section('title')
{{ ucfirst($page) }}
@endsection

@section('content-header-right')
<a href="{{ url('admin/'.$page) }}" class="btn btn-success">{{ ucfirst($page) }}</a>
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12 px-0">
      <div class="card">
        <div class="card-body">
          <input type="hidden" id="dataIdUserClassement" value="{{ $dataId }}">
          <canvas id="classement" width="400" height="400"></canvas>
        </div>
        <div class="card-body">
          <table class="table dataTable">
            <thead>
              <tr>
                <th width="5%">Ranking</th>
                <th width="80%">Name</th>
                <th>Score</th>
              </tr>
            </thead>
            <tbody>
              @foreach($players as $playersData => $p)
              <tr>
                <td>{{ $playersData + 1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->score }}</td>
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

@push('modal')

@endpush
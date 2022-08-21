@extends('backend/layouts/app')
@section('title')
  Start {{ ucfirst($page) }}
@endsection

@section('content-header-right')
  
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
          <div class="row h-100">
            <div class="col-md-6">
              <div class="shadow p-4">
                <h6 class="text-secondary">Game PIN</h6>
                <div class="d-flex justify-content-start align-items-center">
                  <h1 class="game-pin">{{ $data->pin }}</h1>
                  <a href="javascript:void(0)" class="btn btn-sm btn-primary mx-3 btn-copy" data-pin="{{ $data->pin }}">
                    <i class="far fa-copy"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              @if($data->status == 2)
                <a href="javascript:void(0)" id="startQuiz" data-url="{{ url('admin/'.$page.'/start-quiz/'.Crypt::encryptString($data->id)) }}" class="btn btn-success btn-start w-100 h-100 d-flex justify-content-center align-items-center"><i class="fas fa-play mx-3"></i>START</a>
              @elseif($data->status == 3)
                <a href="{{ url('admin/'.$page.'/stop-quiz/'.Crypt::encryptString($data->id)) }}" class="btn btn-danger btn-start w-100 h-100 d-flex justify-content-center align-items-center"><i class="fas fa-stop mx-3"></i>STOP</a>
              @endif
            </div>
          </div>
        </div>
      </div>
      <div class="card mt-4">
        <div class="card-header">
          <h5>All Players</h5>
        </div>
        <div class="card-body">
          <table class="table dataTable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="50%">Name</th>
                <th>Score</th>
                <th>Rank</th>
              </tr>
            </thead>
            <tbody>
              @foreach($players as $playersData => $p)
              <tr>
                <td>{{ $playersData + 1 }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->score }}</td>
                <td>{{ $p->rank }}</td>
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
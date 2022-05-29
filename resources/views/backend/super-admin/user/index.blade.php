@extends('backend/layouts/app')
@section('title')
  Manage {{ ucfirst($page) }}
@endsection

@section('content-header-right')

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
                <th>Name</th>
                <th>Email</th>
                <th>Status</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $datas => $d)
              <tr>
                <td>{{ $datas + 1 }}</td>
                <td>{{ $d->name }}</td>
                <td>{{ $d->email }}</td>
                <td>
                  @if($d->status_id == 1)
                    <div class="badge badge-primary">Active</div>
                  @else 
                    <div class="badge badge-danger">Not Active</div>
                  @endif
                </td>
                <td>
                  <a href="{{ url('super-admin/'.$page.'/'.$d->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-edit"></i></a>
                  <a href="{{ url('super-admin/'.$page.'/delete/'.$d->id) }}" class="btn btn-outline-primary btn-sm"><i class="fas fa-trash"></i></a>
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
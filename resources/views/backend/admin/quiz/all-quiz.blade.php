@extends('backend/layouts/app')
@section('title')
  Manage {{ ucfirst($page) }}
@endsection

@section('content-header-right')
  <a href="{{ url('admin/'.$page) }}" class="btn btn-success">Create {{ ucfirst($page) }}</a>
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
                <th width="15%">Name</th>
                <th width="15%">PIN</th>
                <th width="30%">Status</th>
                <th width="12%"></th>
                <th width="2%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $datas => $d)
              <tr>
                <td>{{ $datas + 1 }}</td>
                <td>{{ $d->name }}</td>
                <td class="font-weight-bold text-primary">{{ $d->pin }}</td>
                <td>
                  <div class="mb-2 d-flex justify-content-end">
                    @if($d->status == 1) 
                      <div class="badge badge-sm badge-secondary">no question yet</div>
                    @elseif($d->status == 2) 
                      <div class="badge badge-sm badge-warning">Ready</div>
                    @elseif($d->status == 3) 
                      <div class="badge badge-sm badge-primary">On Going</div>
                    @elseif($d->status == 4) 
                      <div class="badge badge-sm badge-success">Finish</div>
                    @endif
                  </div>
                  <div class="progress">
                    <div class="progress-bar" 
                      role="progressbar" 
                      style="@if($d->status == 1) width: 25%; @elseif($d->status == 2) width: 50%; @elseif($d->status == 3) width: 75%; @elseif($d->status == 4) width: 100%; @endif" aria-valuemin="0" aria-valuemax="100">
                      @if($d->status == 1) 
                        25%
                      @elseif($d->status == 2) 
                        50%
                      @elseif($d->status == 3) 
                        75%
                      @elseif($d->status == 4) 
                        100%
                      @endif
                    </div>
                  </div>
                </td>
                <td>
                  @if($d->status == 1) 
                    <a href="{{ url('admin/'.$page.'/questions/'.Crypt::encryptString($d->id)) }}" class="btn btn-primary btn-sm btn-block"><i class="fas fa-plus"></i> Questions</a>
                  @elseif($d->status == 2) 
                    <a href="{{ url('admin/'.$page.'/'.Crypt::encryptString($d->id)) }}" class="btn btn-success btn-sm btn-block">Start</a>
                  @elseif($d->status == 3)
                    <a href="{{ url('admin/'.$page.'/detail/'.Crypt::encryptString($d->id)) }}" class="btn btn-primary btn-sm btn-block">Finish</a>
                  @else
                    <button class="btn btn-secondary btn-sm" disabled>Start</a>
                  @endif
                </td>
                <td>
                  @if($d->status == 1 || $d->status == 2)
                    <a href="javascript:void(0)" class="btn text-primary" id="dropdownMenu" data-toggle="dropdown" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                  @endif
                  <div class="dropdown-menu dropdown-action" aria-labelledby="dropdownMenu">
                    @if($d->status == 2)
                      <a href="{{ url('admin/'.$page.'/questions/'.Crypt::encryptString($d->id)) }}" class="dropdown-item text-primary"><i class="fas fa-list"></i> Manage Quiestion</a>
                    @endif
                    @if($d->status == 1 || $d->status == 2)
                      <a href="{{ url('admin/'.$page.'/'.$d->id) }}" class="dropdown-item text-primary"><i class="fas fa-edit"></i> Edit</a>
                      <a href="{{ url('admin/'.$page.'/delete/'.$d->id) }}" class="dropdown-item text-primary"><i class="fas fa-trash"></i> Delete</a>
                    @endif
                  </div>
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

@push('modal')

@endpush
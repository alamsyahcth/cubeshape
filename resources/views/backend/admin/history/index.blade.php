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
          <table class="table dataTable">
            <thead>
              <tr>
                <th width="5%">No</th>
                <th width="15%">Name</th>
                <th width="45%">Status</th>
                <th width="10%"></th>
              </tr>
            </thead>
            <tbody>
              @foreach($data as $datas => $d)
              <tr>
                <td>{{ $datas + 1 }}</td>
                <td>{{ $d->name }}</td>
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
                    <div class="progress-bar" role="progressbar"
                      style="@if($d->status == 1) width: 25%; @elseif($d->status == 2) width: 50%; @elseif($d->status == 3) width: 75%; @elseif($d->status == 4) width: 100%; @endif"
                      aria-valuemin="0" aria-valuemax="100">
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
                  @if($d->status == 4)
                    <a href="{{ url('admin/'.$page.'/'.Crypt::encryptString($d->id)) }}" class="btn btn-primary btn-sm btn-block"><i class="fas fa-chart-bar"></i> Classement</a>
                  @else
                    <button class="btn btn-secondary btn-sm" disabled><i class="fas fa-chart-bar"></i>Classement</a>
                  @endif
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
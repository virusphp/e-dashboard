@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.pegawai') }}">Pegawai</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header">
        <strong class="controls align-middle">Pegawai</strong>
        @include('simrs.search.search', ['route' => $route])
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Pegawai</th>
              <th>Nama Pegawai</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_pegawai as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->kd_pegawai }}</td>
              <td>{{ $data->gelar_depan.' '.$data->nama_pegawai.$data->gelar_belakang }}</td>
              <td>
                <span class="badge badge-success">Active</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $data_pegawai->links() !!}
      </div>
  </div>
</div>

@endsection
@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.tarifkarcis') }}">Pasien</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header text-center">
          <strong class="controls align-middle">Pasien</strong>
          @include('simrs.search.search')
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>No RM</th>
              <th>Nama Pasien</th>
              <th>Jenis kelamin</th>
              <th>Orang Tua</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($data_pasien as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ hide($data->no_RM) }}</td>
              <td>{{ $data->nama_pasien }}</td>
              <td>{{ kelamin($data->jns_kel) }}</td>
              <td>{{ $data->nama_orang_tua }}</td>
              <td>
                <span class="badge badge-success">Active</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $data_pasien->links() !!}
      </div>
  </div>
</div>

@endsection
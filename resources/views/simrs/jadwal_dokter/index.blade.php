@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('simrs.tarifkarcis') }}">Jadwal Dokter</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header text-center">
          <strong class="controls align-middle">Jadwal Dokter</strong>
          @include('simrs.search.search')
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Dokter</th>
              <th>Poliklinik</th>
              <th>Hari</th>
              <th>Kuota</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwal_dokter as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nama_pegawai }}</td>
              <td>{{ $data->nama_sub_unit }}</td>
              <td>{{ tanggalHari($data->Kd_Hari) }}</td>
              <td>{{ $data->Kuota }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $jadwal_dokter->links() !!}
      </div>
  </div>
</div>

@endsection
@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('simrs.jadwaldokterpengganti') }}">Jadwal Dokter Pengganti</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header text-center">
          <div class="float-left">
            <a href="{{ route('simrs.dokterpengganti.create') }}" class="btn btn-xs btn-secondary">+</a>
          </div>
          <strong class="controls align-middle">Jadwal Dokter Pengganti</strong>
          @include('simrs.search.search')
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Pegawai</th>
              <th>Poliklinik</th>
              <th>Tanggal</th>
              <th>Status</th>
              <th>Keterangan</th>
            </tr>
          </thead>
          <tbody>
            @foreach($jadwal_dokter_pengganti as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->gelar_depan.' '.$data->nama_pegawai.' '.$data->gelar_belakang}}</td>
              <td>{{ $data->nama_sub_unit }}</td>
              <td>{{ tanggalsaja($data->tanggal) }}</td>
              <td>{{ $data->status_pergantian }}</td>
              <td>{{ $data->keterangan }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $jadwal_dokter_pengganti->links() !!}
      </div>
  </div>
</div>
@endsection
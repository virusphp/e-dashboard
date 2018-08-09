@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.tarifkarcis') }}">Kamar</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header text-center">
          <strong class="controls align-middle">Kamar</strong>
          @include('simrs.search.search')
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Ruang</th>
              <th>Kelas</th>
              <th>No Tempat Tidur</th>
              <th>Jumlah</th>
              <th>Terpakai</th>
              <th>Sisa</th>
              <th>Tarif Kamar</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            @foreach($d_kamar as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nama_sub_unit }}</td>
              <td>{{ $data->kd_kelas }}</td>
              <td>{{ $data->keterangan }}</td>
              <td>{{ $data->jml_tmp_tidur }}</td>
              <td>{{ $data->jml_terpakai }}</td>
              <td>{{ $data->jml_tmp_tidur - $data->jml_terpakai }}</td>
              <td>{{ rupiah($data->tarif_kamar) }}</td>
              <td>
                <span class="badge badge-success">Active</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $d_kamar->links() !!}
      </div>
  </div>
</div>

@endsection
@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.tarifkarcis') }}">Tarif Poliklinik</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
  <div class="card">
      <div class="card-header">
          <strong class="controls align-middle">Tarif Poliklinik</strong>
          @include('simrs.search.search', ['route' => $route])
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Poliklinik</th>
              <th>Tarif (Rp)</th>
              <th>Keterangan</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($tarif_karcis as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->nama_sub_unit }}</td>
              <td>{{ rupiah($data->harga) }}</td>
              <td>{{ $data->nama_tarif }}</td>
              <td>
                <span class="badge badge-success">Active</span>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $tarif_karcis->links() !!}
      </div>
  </div>
</div>

@endsection
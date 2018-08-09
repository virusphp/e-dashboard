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
  <div class="row">

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Senin </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($senin as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Selasa </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($selasa as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Rabu </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($rabu as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Rabu </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($kamis as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Jum'at </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($jumat as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card">
        <div class="card-header">
          <strong> Sabtu </strong>
        </div>
        <div class="card-body">
          <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
            @foreach($sabtu as $d)
              <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
              <p>{{ $d->nama_sub_unit }}</p>
            @endforeach
          </div>
        </div>
      </div>
    </div>

<div class="card">
  <div class="card-header">
    Card actions
    <div class="card-header-actions">
      <a href="#" class="card-header-action btn-setting">
      <i class="icon-settings"></i>
      </a>
      <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#collapseExample" aria-expanded="true" style="">
      <i class="icon-arrow-up"></i>
      </a>
      <a href="#" class="card-header-action btn-close">
      <i class="icon-close"></i>
      </a>
    </div>
  </div>
  <div class="card-body collapse show" id="collapseExample" style="">
    Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex
    ea commodo consequat.
  </div>
</div>

  </div>
</div>

@endsection
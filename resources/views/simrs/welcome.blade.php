@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{ route('simrs.index') }}">Home</a>
    </li>
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
@endsection

@section('content')
<div class="card">
  <div class="card-header text-center">
    Pengumuman
  </div>
  <div class="card-body">
    RSUD Kraton adalah Rumah sakit umum daerah Kabupaten Pekalongan
    ini adalah layanan Sistem Informasi Rumah Sakit minipack yang di desain
    dengan minimum service serta modul modul yang terintegrasi secara langsung
  </div>
</div>

<div class="col-md-12">
    <div class="card-body">
      <h2 class="text-center">JADWAL DOKTER</h2>   
    </div> 
</div>
<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Senin
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#senin" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="senin" style="">
      <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($senin as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Selasa
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#selasa" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="selasa" style="">
      <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($selasa as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Rabu
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#rabu" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="rabu" style="">
      <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($rabu as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Kamis
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#kamis" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="kamis" style="">
      <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($kamis as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Jum'at
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#jumat" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="jumat" style="">
      <div id="jumat" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($jumat as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>

<div class="col-md-4">
  <div class="card">
    <div class="card-header">
      Sabtu
      <div class="card-header-actions">
        <a href="#" class="card-header-action btn-minimize" data-toggle="collapse" data-target="#sabtua" aria-expanded="false" style="">
        <i class="icon-arrow-up"></i>
        </a>
      </div>
    </div>
    <div class="card-body collapse" id="sabtua" style="">
      <div id="sabtu" data-spy="scroll" data-target="#list-example" data-offset="0" style="height: 200px; overflow: auto">
        @foreach($sabtu as $d)
          <h4 id="list-item-{{ $loop->iteration }}">{{ $d->nama_pegawai }}</h4>
          <p>{{ $d->nama_sub_unit }}</p>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection
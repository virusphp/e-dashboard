@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('satuan.index') }}">Satuan</a> 
            </li>
            <li class="breadcrumb-item active" aria-current="page">Create</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Buat Satuan</div>

                <div class="card-body">
                    {!! Form::open(['route' => 'satuan.store']) !!}
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="nama_satuan">Nama Satuan</label>
                                <input type="text" name="nama_satuan" class="form-control" id="nama_satuan" placeholder="Nama satuan...">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="keterangan">Keterangan</label>
                                <p>* <strong>Nama satuan</strong> wajib di isi</label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

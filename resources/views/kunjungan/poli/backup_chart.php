@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Kunjungan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Chart Kunjungan
                    <div class="form-inline float-right">
                        <form action="{{ route('daftar.chart') }}" role="search" class="form-inline">
                            <label for="tanggal" class="control-label mr-sm-2">Tanggal</label>
                            {!! Form::select('tanggal', tanggal(),null, ['class' => 'form-control mr-sm-2']) !!}
                            <label for="bulan" class="control-label mr-sm-2">Bulan</label>
                            {!! Form::select('bulan', bulan(),null, ['class' => 'form-control mr-sm-2']) !!}
                            <label for="tahun" class="control-label mr-sm-2">Tahun</label>
                            {!! Form::select('tahun', tahun(),null, ['class' => 'form-control mr-sm-2']) !!}
                            <button type="submit" class="btn btn-secondary">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                    </div>
                </div>

                <div class="card-body">
                    <div id="chart-div"></div>
                    <?= $lava->render('PieChart', 'IMDB', 'chart-div') ?>
                    <div id="finances-div"></div>
                    <?= $lava->render('ComboChart', 'Finances', 'finances-div') ?>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

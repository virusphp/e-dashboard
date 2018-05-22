@extends('layouts.app')

@section('content')
<div class="container-fluid">
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
                    Tabel Kunjungan
                    <div class="form-inline float-right mb-2 mr-sm-4">
                        {{--  <form action="{{ route('daftar.poli') }}" class="form-inline" role="search" >
                            <label for="tanggal" class="control-label mb-2 mr-sm-2">Per Bulan</label>
                            {!! Form::select('bulan', ['' => 'Bulan']+bulan(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2']) !!}
                            {!! Form::select('tahun', ['' => 'Tahun']+tahun(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2']) !!}
                            <button type="submit" class="btn btn-sm btn-dark mb-2 mr-sm-2">
                                <i class="fa fa-print"></i>
                            </button>
                        </form>  --}}
                        <form id="form_tabel" action="{{ route('daftar.poli') }}" class="form-inline" role="search" >
                            <label for="tanggal" class="control-label mb-2 mr-sm-2">Per Bulan</label>
                            {!! Form::select('bulan', ['' => 'Bulan']+bulan(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2', 'id' => 't_bulan']) !!}
                            {!! Form::select('tahun', ['' => 'Tahun']+tahun(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2', 'id' => 't_tahun']) !!}
                            <button type="submit" class="btn btn-sm btn-secondary mb-2 mr-sm-2">
                                <i class="fa fa-search"></i>
                            </button>
                        </form> 
                        <button id="print_tabel" type="submit" class="btn btn-sm btn-dark mb-2 mr-sm-2">
                            <i class="fa fa-print"></i>
                        </button>

                        <form id="tabel_harian" action="{{ route('daftar.poli') }}" role="search" class="form-inline">
                            <label class="mb-2 control-label mr-sm-2">Per Hari</label>
                            <div class="mb-2 input-append date form_date mr-sm-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input class="form-control form-control-sm" id="hari" placeholder="Tanggal" type="text" name="hari" readonly>
                                <span class="btn btn-sm btn-secondary add-on"><i class="fa fa-bg fa-calendar"></i></span>
                                <input type="hidden" id="dtp_input2" value="" /><br/>
                            </div>
                            <button id="cari" type="submit" class="btn btn-sm btn-secondary mb-2 mr-sm-2">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <button id="print_tabel_harian" type="submit" class="btn btn-sm btn-dark mb-2 mr-sm-2">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body" id="print_isi">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Klinik</th>
                                <th scope="col">Total Pengunjung</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($klinik as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->nama_klinik }}</td>
                                <td>{{ $data->total_klinik }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('css')
<link href="{{ asset('plugins/datetimepicker/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ asset('plugins/datetimepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script src="{{ asset('plugins/datetimepicker/js/locales/bootstrap-datetimepicker.id.js') }}"></script>

<script type="text/javascript">
   
    $('.form_date').datetimepicker({
        language:  'id',
        format: 'yyyy-mm-dd',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });

    $('#print_tabel').on('click',function(){
        var data = $('#form_tabel').serialize();
        window.open('klinik/print?' + data ,'_blank');
     
    });

    $('#print_tabel_harian').on('click',function(){
        var url = window.location.toString();
        var data = url.split('?')
        window.open('klinik/print?' + data[1] ,'_blank');
    });

</script>
@endpush

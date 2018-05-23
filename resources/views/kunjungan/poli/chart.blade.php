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
                    Chart Kunjungan
                    <div class="form-inline float-right mb-2 mr-sm-4">
                         <form id="form_chart" action="{{ route('daftar.chartjs') }}" class="form-inline" role="search" >
                            <label for="tanggal" class="control-label mb-2 mr-sm-2">Per Bulan</label>
                            {!! Form::select('bulan', ['' => 'Bulan']+bulan(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2']) !!}
                            {!! Form::select('tahun', ['' => 'Tahun']+tahun(),null, ['class' => 'form-control form-control-sm mb-2 mr-sm-2']) !!}
                            <button type="submit" class="btn btn-sm btn-secondary mb-2 mr-sm-2">
                                <i class="fa fa-search"></i>
                            </button>
                        </form> 
                        <button id="print_chart" type="submit" class="btn btn-sm btn-dark mb-2 mr-sm-2">
                            <i class="fa fa-print"></i>
                        </button>
                        <form id="form_chart_harian" action="{{ route('daftar.chartjs') }}" id="form" role="search" class="form-inline">
                            <label class="mb-2 control-label mr-sm-2">Per Hari</label>
                            <div class="mb-2 input-append date form_date mr-sm-2" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="dd-mm-yyyy">
                                <input class="form-control form-control-sm" id="hari" placeholder="Tanggal" type="text" name="hari" readonly>
                                <span class="btn btn-sm btn-secondary add-on"><i class="fa fa-sm fa-calendar"></i></span>
                                <input type="hidden" id="dtp_input2" value="" /><br/>
                            </div>
                            <button id="cari" type="submit" class="btn btn-sm btn-secondary mb-2 mr-sm-2">
                                <i class="fa fa-search"></i>
                            </button>
                        </form>
                        <button id="print_chart_harian" type="submit" class="btn btn-sm btn-dark mb-2 mr-sm-2">
                            <i class="fa fa-print"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <canvas id="canvas" height="280" width="600"></canvas>
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
<script src="{{ asset('js/chart.bundle.js') }}"></script>

<script type="text/javascript">
    var data_tanggal = <?php echo $tanggal; ?>;
    var nama_klinik = <?php echo $klinik; ?>;
    var data_pengunjung = <?php echo $pengunjung; ?>;


    var barChartData = {
        labels: nama_klinik,
        datasets: [{
            label: 'Klinik',
            backgroundColor: "rgba(220,220,220,0.5)",
            pointBackgroundColor: "rgba(0,0,255,0.3)",
            data: nama_klinik
        }, {
            label: 'Pengunjung',
            backgroundColor: "rgba(0,0,255,0.3)",
            data: data_pengunjung
        }]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 3,
                        borderColor: 'rgba(0,0,255,0.3)',
                        pointBackgroundColor: "rgba(220,220,220,0.5)",
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    fontSize: 15,
                    text: 'Data Penggunjung '+ data_tanggal
                }
            }
        });


    };
    
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

    $('#print_chart').on('click',function(){
        var data = $('#form_chart').serialize();
        console.log(data);
        window.open('chartjs/print?' + data ,'_blank');
     
    });

    $('#print_chart_harian').on('click',function(){
        var url = window.location.toString();
        var data = url.split('?')
        {{--  console.log(data);  --}}
        window.open('chartjs/print?' + data[1] ,'_blank');
    });

</script>
@endpush

@extends('layouts.print')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="text-center">
                    <h2><strong>LAPORAN KUNJUNGAN PASIEN</strong></h2>
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
<style type="text/css" media="print">
    @page { size: landscape; }
    audio, canvas, video { display: inline-block; *display: inline; zoom: 1; }
    .L { 
        width: 100%; 
        height: 100%; 
        margin: 0% 0% 0% 0%; 
        filter: progid:DXImageTransform.Microsoft.BasicImage(Rotation=3);
       } 
</style>
@endpush
@push('scripts')
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
            pointBackgroundColor: "rgba(220,220,220,0.5)",
            data: nama_klinik
        }, {
            label: 'Pengunjung',
            backgroundColor: "rgba(151,187,205,0.5)",
            data: data_pengunjung
        }]
    };


    window.onload = function() {
        var ctx = document.getElementById("canvas").getContext("2d");
        var scale = 'scale(1)';
        document.body.style.webkitTransform =  scale;    // Chrome, Opera, Safari
        document.body.style.msTransform =   scale;       // IE 9
        document.body.style.transform = scale;     // General
        window.myBar = new Chart(ctx, {
            type: 'bar',
            data: barChartData,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 3,
                        borderColor: 'rgb(0, 255, 0)',
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
        window.print(); 
        setTimeout(window.close,0);
    };
   $('#body').addClass('L') 
   
</script>
@endpush
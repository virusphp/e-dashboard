@extends('layouts.simrs.app')
@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>
    <li class="breadcrumb-item">
      <a href="{{ route('simrs.jadwaldokterpengganti') }}">Jadwal Dokter Pengganti</a>
    </li>
    <li class="breadcrumb-item active">Create</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <strong>Jadwal Dokter Pengganti</strong>
            <small>Form</small>
        </div>
        <div class="card-body">
            {!! Form::open(['url' => 'okoc']) !!}
                <div class="form-group">
                    <label for="dokter">Nama Dokter</label>
                    {{-- <input type="text" class="form-control" placeholder="Masukan Nama Dokter"> --}}
                    {!! Form::select('dokter', $dokter, null, ['id' => 'dokter', 'class' => 'form-control']) !!}
                </div>
                <div class="form-group">
                    <label for="street">Poliklinik</label>
                    <select class="form-control" id="poliklinik" name="poliklinik">
                    </select>
                    {{-- {!! Form::select('poliklinik', $poli, null, ['class' => 'form-control']) !!} --}}
                </div>
                <div class="form-group">
                    <label for="vat">Keterangan</label>
                    <textarea rows="4" class="form-control" placeholder="Keterangan"></textarea>
                </div>
                <div class="row">
                    <div class="form-group col-sm-8">
                        <label for="city">Tanggal</label>
                        <div class="controls">
                            <div class='input-group date' id='datetimepicker'>
                                <input type='text' name="tgl" class="form-control" placeholder="Tanggal..." />
                                <span class="input-group-addon">
                                    <button type="button" class="btn btn-primary">
                                        <span class="fa fa-calendar">
                                        </span>
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" >
                        <label for="postal-code">Status</label>
                        <select class="form-control" name="status" id="status">
                            <option value="">Pilih Status</option>
                            <option value="0">Berangkat</option>
                            <option value="1">Izin</option>
                        </select>
                    </div>
                </div>
    
                <div class="form-group">
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection
@push('css')
{{-- <link rel="stylesheet" href="{{ asset('core-ui/css/bootstrap.min.css') }}" /> --}}
<link rel="stylesheet" href="{{ asset('core-ui/datepicker/css/bootstrap-datetimepicker.min.css') }}" />
@endpush
@push('scripts')
<script type="text/javascript" src="{{ asset('core-ui/moment/min/moment.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('core-ui/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('core-ui/datepicker/js/bootstrap-datetimepicker.min.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker').datetimepicker({
            format: 'Y-M-D'
        });
    });
$(document).ready(function()
{
    $('#dokter').change(function(e){
    var kd_pegawai = e.target.value;
    var token = "{{ csrf_token() }}";
    console.log(kd_pegawai);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
        $.ajax({
            type: "POST",
            dataType: "JSON",
            url: "{{ route('api.simrs.poli') }}",
            data: {"kd_pegawai": kd_pegawai}, 
            success: function(data) {
                var model = $('#poliklinik');
					model.empty();
                $.each(data, function(index, element) {
                    model.append("<option value='"+ element.kd_sub_unit +"'>" + element.nama_sub_unit + "</option>");
                });

            }
        })
    });
})
</script>
@endpush
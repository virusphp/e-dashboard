@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.reg.rjalan') }}">Pasien</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
<div class="row">

  <div class="col-md-4">
    <div class="card">

      <div class="card-header">
        <strong>Data Pasien Rawat Jalan</strong>
        <small>Form</small>
      </div>
      <div class="card-body">

        <div class="row">
          <div class="col-sm-12">
          <form action="{{ route('simrs.reg.pasien') }}" method="post" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
              <label for="name">NO RM</label>
              <input type="text" name="norm" class="form-control" id="norm" placeholder="Masukan nomer RM">
              <input type="hidden" name="no_rm" class="form-control" id="no_rm" placeholder="Masukan nomer RM">
              <input type="hidden" name="_token" class="form-control" id="token" value="{{ csrf_token() }}">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="ccnumber">Nama Pasien</label>
              <input type="text" name="nama_pasien" class="form-control" id="nama_pasien" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="ccnumber">Alamat Pasien</label>
              <input type="text" name="alamat_pasien" class="form-control" id="alamat_pasien" readonly>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label for="ccnumber">Jenis Kelamin</label>
              <input type="text" name="jenis_kelamin" class="form-control" id="jenis_kelamin" readonly>
              <!-- <input type="hidden" name="jenis_pasien" class="form-control" id="jenis_pasien" readonly> -->
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
@include('simrs.registrasi.form')

</div>
  
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$('#norm').on('keyup',function(){
  if (this.value.length < 6) {
    $('#nama_pasien').val('');
    $('#alamat_pasien').val('');
    $('#jenis_kelamin').val('');
    return;
  }
    var value=$(this).val();
    // console.log(value);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    $.ajax({
        type : 'post',
        url : '{{ route('simrs.getpasien')}}',
        data:{_token: CSRF_TOKEN, no_rm: value},
        success:function(data){
          $.each(data, function(i, item){
            $('#no_rm').val(item.no_RM);
            $('#nama_pasien').val(item.nama_pasien);
            $('#alamat_pasien').val(item.alamat);
            if (item.jns_kel == 0) {
              var kelamin = "Perempuan";
            } else {
              var kelamin = "Laki - laki";
            }
            $('#jenis_kelamin').val(kelamin);
          });
        }
    });
})
</script>
@endpush
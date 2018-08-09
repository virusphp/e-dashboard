<div class="col-md-8">
    <div class="card">
        <div class="card-body">
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="no_telp">No Hp</label>
                        <div class="col-md-9">
                        <input type="text" id="no_telp" name="no_telp" class="form-control" placeholder="No HP">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="tgl_reg">Tanggal Periksa</label>
                        <div class="col-md-9">
                        <input type="text" id="tgl" name="tgl" class="form-control" value="{{ tanggalsaja($tgl_periksa) }}" readonly>
                        <input type="hidden" id="tgl_reg" name="tgl_reg" class="form-control" value="{{ $tgl_periksa }}" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Klinik</label>
                    <div class="col-md-9">
                        <select id="klinik" name="klinik" class="form-control">
                            <option value="x">Pilih Klinik</option>
                        @foreach($klinik as $d)
                            <option value="{{ $d->kd_sub_unit }}">{{ $d->nama_sub_unit }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                 <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="tarif">Tarif Klinik</label>
                        <div class="col-md-9">
                        <input type="text" id="tarif" name="tarif" class="form-control" readonly>
                        <input type="hidden" id="tarif_klinik" name="tarif_klinik" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="tarif">Dokter Klinik</label>
                        <div class="col-md-9">
                        <input type="text" id="dokter" name="dokter" class="form-control" readonly>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-md-3 col-form-label" for="select1">Jenis Pasien</label>
                    <div class="col-md-9">
                        <select id="jns_pasien" name="jns_pasien" class="form-control">
                            <option value="x">Pilih Jenis pasien</option>
                            @foreach($cara_bayar as $d)
                            <option value="{{ $d->kd_cara_bayar }}">{{ $d->keterangan }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
           
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-dot-circle-o"></i> Submit</button>
            <button type="reset" class="btn btn-sm btn-danger">
            <i class="fa fa-ban"></i> Reset</button>
            </div>
        </div>
    </form> 
</div>
@push('scripts')
<script type="text/javascript">
$('#klinik').change(function() {
  if (this.value === "x") {
    $('#tarif').val('');
    $('#dokter').val('');
    return;
  }
    var value=$(this).val(),
    tgl = $('#tgl_reg').val();
    // console.log(value);
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    $.ajax({
        type : 'post',
        url : '{{ route('simrs.tarif')}}',
        data:{_token: CSRF_TOKEN, kd_sub: value, tgl: tgl},
        success:function(data){
            console.log(data);
          $.each(data, function(i, item){
            $('#tarif').val(item.harga_klinik);
            $('#tarif_klinik').val(item.harga);
            $('#dokter').val(item.nama_pegawai);
          });
        }
    });
})
</script>
@endpush
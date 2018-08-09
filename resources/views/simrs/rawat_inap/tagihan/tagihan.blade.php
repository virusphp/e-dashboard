@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.tarifkarcis') }}">Rawat Jalan</a>
    </li>
    <li class="breadcrumb-item active">Index</li>
</ol>
@endsection
@section('content')
<div class="col-md-12">
    @if (count($errors))
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>
              {{ $error }}
          </li>
        @endforeach
      </ul>
    </div>
  @endif
</div>
<div class="col-md-12">
  <div class="card">
      <div class="card-header">
         INVOICE #{{ $tagihan_pasien->no_tagihan }} 
         <div class="float-right">
            <div class="controls">
              <div class="input-group">
                <button class="btn btn-dark" onclick="goBack()">BACK</button>
              </div>
            </div>
         </div>
      </div>
      <div class="card-body">
        <div class="row mb-4">
          <div class="col-sm-4">
           <div> #Dari </div>
           <div><strong>{{ $tagihan_pasien->nama_pasien }}</strong> </div>
           <div> {{ $tagihan_pasien->alamat.' '.$tagihan_pasien->nama_kelurahan.' '.$tagihan_pasien->nama_kecamatan }} </div>
           <div> {{ kelamin($tagihan_pasien->jns_kel) }} </div>
           <div> {{ $tagihan_pasien->no_telp }} </div>
          </div>
          <div class="col-sm-4">
            <div> #Pembayaran</div>
            <div> RSUD KRATON</div>
            <div> Kab Pekalongan</div>
          </div>
          <div class="col-sm-4">
            <div> #Detail</div>
            <div> Invoice #{{ $tagihan_pasien->no_tagihan }}</div>
            <div> {{ tanggalsaja($tagihan_pasien->tgl_tagihan) }}</div>
            <div> TRX: {{ $tagihan_pasien->no_bukti }}</div>
            <div> RM: {{ $tagihan_pasien->no_RM }}</div>
          </div>
        </div>
        <table class="table table-responsive-block table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>No Reg</th>
              <th>Ruangan</th>
              <th>Dokter Peymeriksa</th>
              <th>Harga</th>
              <th>Status Bayar</th>
            </tr>
          </thead>
          <tbody>
           <tr>
              <td>#</td>
              <td>{{ $tagihan_pasien->no_Reg }}</td>
              <td>{{ $tagihan_pasien->nama_sub_unit }}</td>
              <td>{{ $tagihan_pasien->nama_pegawai }}</td>
              <td>{{ rupiah($tagihan_pasien->tagihan) }}</td>
              <td>
                <span class="badge badge-{{ $tagihan_pasien->status_bayar == 'SUDAH' ? 'success' : 'secondary' }}">
                  {{ $tagihan_pasien->status_bayar }}
                </span>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
  </div>
</div>
@endsection
@push('scripts')
<script>
function goBack() {
    window.history.back();
}
</script>
@endpush
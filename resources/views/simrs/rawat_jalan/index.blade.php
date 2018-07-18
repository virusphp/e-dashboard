@extends('layouts.simrs.app')

@section('breadcrumb')
<ol class="breadcrumb">
    <li class="breadcrumb-item">
      Master
    </li>

    <li class="breadcrumb-item">
      <a href="{{ route('simrs.rawatjalan') }}">Rawat Jalan</a>
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
          @include('simrs.search.datepicker')
      </div>
      <div class="card-body">
        <table class="table table-responsive-block table-hover table-bordered">
          <thead>
            <tr>
              <th>No</th>
              <th>No Reg</th>
              <th>No RM</th>
              {{-- <th>No Bukti</th> --}}
              <th>Nama Pasien</th>
              <th>Jenis Kelamin</th>
              <th>Poliklinik</th>
              <th>Dokter Pemeriksa</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            @foreach($rawat_jalan as $data)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $data->no_reg }}</td>
              <td>{{ hide($data->no_RM) }}</td>
              {{-- <td>{{ $data->no_bukti }}</td> --}}
              <td>{{ $data->nama_pasien }}</td>
              <td>{{ kelamin($data->jns_kel) }}</td>
              <td>{{ $data->nama_sub_unit }}</td>
              <td>{{ $data->nama_pegawai }}</td>
              <td>
                  <a href="{{ route('simrs.tagihan', $data->no_reg) }}" id="mtagihan" class="btn btn-success btn-sm">
                    <i class="icon-eye icons"></i> view
                  </a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        {!! $rawat_jalan->appends(Request::all())->links() !!}
      </div>
  </div>
</div>
@endsection
@push('css')
<link rel="stylesheet" href="{{ asset('core-ui/css/bootstrap.min.css') }}" />
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
    $(function () {
        $('#datetimepicker1').datetimepicker({
            format: 'Y-M-D'
        });
    });
    $(function () {
        $('#datetimepicker2').datetimepicker({
            format: 'Y-M-D'
        });
    });

</script>
@endpush
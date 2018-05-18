@extends('layouts.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Jadwal</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Jadwal Dokter</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table id="table" role="grid" class="table table-striped">
                        <thead>
                            <tr role="row">
                                <th scope="col">#</th>
                                <th scope="col">Nama Dokter</th>
                                <th scope="col">Nama Klinik</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
<script>
        {{--  $('#table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("daftar.dokter") }}',
            columns: [
                {data: 'nama_pegawai'},
                {data: 'nama_sub_unit'}
            ]
        });
  --}}
       
        $('#table').DataTable({
            processing: true,
            serverSide: true,
            order: [ [0, 'desc'] ],
            oLanguage: {
                "sLengthMenu": "_MENU_ ",
            },
            ajax: '{{route("daftar.dokter")}}',
            "fnCreatedRow": function (row, data, index) {
                $('td', row).eq(0).html(index + 1);
            },
            columns: [
                {data: 'Kd_Pegawai', name: 'Kd_Pegawai'},
                {data: 'nama_pegawai', name: 'nama_pegawai'},
                {data: 'nama_sub_unit', name: 'nama_sub_unit'}
            ],  
            initComplete: function () {
                this.api().columns().every(function () {
                    var column = this;
                    var input = document.createElement("input");
                    $(input).appendTo($(column.footer()).empty())
                    .on('change', function () {
                        column.search($(this).val(), false, false, true).draw();
                    });
                });
            }     
        });
    
</script>
@endpush

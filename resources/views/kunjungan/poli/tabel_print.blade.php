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
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-bordered">
                      
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nama Klinik</th>
                                <th scope="col">Total Pengunjung</th>
                            </tr>
                       
                            @foreach($klinik as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->nama_klinik }}</td>
                                <td>{{ $data->total_klinik }}</td>
                            </tr>
                            @endforeach
             
                    </table>
                            <p>Total Pengunjung : {{ $total }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
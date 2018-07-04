@extends('layouts.report.app')

@section('content')
<div class="container">
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
                <div class="card-header">Daftar Kunjungan</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">No Reg</th>
                                <th scope="col">Dibuat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($poliklinik as $poli)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $poli->no_reg }}</td>
                                <td>{{ $poli->no_RM }}</td>
                                <td>Edit</td>
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

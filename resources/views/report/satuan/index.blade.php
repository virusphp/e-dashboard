@extends('layouts.report.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">Satuan</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('satuan.create') }}" class="btn btn-sm btn-primary plus-m">
                <i class="fa fa-plus-circle"></i> Primary
            </a>
            <div class="card">
                <div class="card-header">Satuan</div>

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
                                <th scope="col">Nama Satuan</th>
                                <th scope="col">Dibuat</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($satuan as $sat)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $sat->nama_satuan }}</td>
                                <td>{{ $sat->created_at }}</td>
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

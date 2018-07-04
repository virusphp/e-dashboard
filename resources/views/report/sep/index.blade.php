@extends('layouts.report.app')

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
               <a href="{{ route('home') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">SEP</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Hapus SEP</div>

                <div class="card-body">
                    @if (session('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="sep">No SEP</label>
                        <input type="text" name="no_sep" class="form-control" id="cari-sep" aria-describedby="sepHelp" placeholder="Masukan No SEP">
                        <small id="sepHelp" class="form-text text-muted">Masukan nomer SEP yang ingin anda hapus.</small>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No RM</th>
                                <th>No SEP</th>
                                <th>Nama Peserta</th>
                                <th>Nama Poli</th>
                                <th>Pekerjaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
$('#cari-sep').on('keyup',function(){
    if(this.value.length < 19) return;
    var value=$(this).val();
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content')
    $.ajax({
        type : 'post',
        url : '{{ route('sep.cariSep')}}',
        data:{_token: CSRF_TOKEN, no_sep: value},
        success:function(data){
            // console.log(data);
            $('tbody').html(data);
        }
    });
})
$('#delete-sep').append('{{ csrf_field() }}');
</script>
<script type="text/javascript">
    // $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
</script>
@endpush

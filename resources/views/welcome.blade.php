@extends('layouts.portal.app')

@section('content')
<div class="jumbotron jumbotron-fluid j-trans">
    <div class="container">
        <h1 class="cover-heading">Portal Applikasi E-Hospital</h1>
        <div class="row">
            <div class="col">
                    <a class="logo-menu" href="http://epasien.rsudkraton.com">
                        <img width="80" height="80" src="{{ asset('images/register.png')  }}" alt=""> 
                        Pendaftaran
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('simrs.index') }}">
                        <img width="80" height="80" src="{{ asset('images/dokter.png')  }}" alt=""> 
                        SIMRS
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('login') }}">
                        <img width="80" height="80" src="{{ asset('images/apotik.png')  }}" alt=""> 
                        Report
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="http://docs.rsudkraton.com">
                        <img width="80" height="80" src="{{ asset('images/kontak.png')  }}" alt=""> 
                        Kontak Kami
                    </a>
            </div>
        </div>
    </div>
</div>
@endsection

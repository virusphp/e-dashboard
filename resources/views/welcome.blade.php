@extends('layouts.portal.app')

@section('content')
<div class="jumbotron jumbotron-fluid j-trans">
    <div class="container">
        <h1 class="cover-heading">Portal Applikasi E-Hospital</h1>
        <div class="row">
            <div class="col">
                    <a class="logo-menu" href="{{ route('vclaim.bpjs') }}">
                        <img width="80" height="80" src="{{ asset('images/logo-bpjs.png')  }}" alt=""> 
                        Vclaim Bpjs
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('sisrute') }}">
                        <img width="80" height="80" src="{{ asset('images/logo-sisrute.png')  }}" alt=""> 
                        Sisrute
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('siranap') }}">
                        <img width="100" height="80" src="{{ asset('images/logo-sisrute.png')  }}" alt=""> 
                        Siranap
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('ctki') }}">
                        <img width="100" height="80" src="{{ asset('images/logo-sisrute.png')  }}" alt=""> 
                        Ctki
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('sijarimas') }}">
                        <img width="100" height="80" src="{{ asset('images/logo-sijarimas.png')  }}" alt=""> 
                        SijariEmas
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('katalog') }}">
                        <img width="100" height="80" src="{{ asset('images/logo-lkpp.png')  }}" alt=""> 
                        Katalog
                    </a>
            </div>
            <div class="col">
                    <a class="logo-menu" href="{{ route('gmail') }}">
                        <img width="100" height="80" src="{{ asset('images/logo-gmail.png')  }}" alt=""> 
                        Gmail
                    </a>
            </div>

            <div class="col">
                    <a class="logo-menu" href="http://epasien.rsudkraton.id">
                        <img width="80" height="80" src="{{ asset('images/register.png')  }}" alt=""> 
                        Pendaftaran
                    </a>
            </div>
        </div>
    </div>
</div>
@endsection
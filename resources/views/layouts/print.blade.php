<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=0.5">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>** Laporan Kunjungan **</title>
   
    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
    <!-- Styles -->
    <link href="{{ asset('css/app.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/print.css') }}" rel="stylesheet">
    @stack('css')
</head>
<body onload="window.print(); setTimeout(window.close,0);">
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>   
    <!-- Scripts -->
    <script src="{{ asset('js/app.min.js') }}"></script>
    {{--  <script src="{{ asset('js/bootstrap.min.js') }}"></script>  --}}
    <script src="{{ asset('js/Chart.min.js') }}"></script>
    @stack('scripts')
</body>
</html>

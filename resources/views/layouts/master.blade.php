<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        <!-- CSS -->
        <link rel="stylesheet" href="{{ url('css/app.css') }}">
        <link rel="stylesheet" href="{{ url('css/main.css') }}">
        
        @yield('css')
        
        <title>@yield('title') - AppEntrega</title>
    </head>
    
<body>
    @include('layouts.nav')
        
        <div class="container-fluid">
        @yield('content')  
        </div>
        @include('layouts.footer')

    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/jquery.mask.min.js') }}"></script>
    @yield('script')
</body>
</html>
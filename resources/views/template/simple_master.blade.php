<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta id="vp" name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script>
        // Screen cannot be less then 450px wide
    window.onload = function() {
        if (screen.width < 450) {
            var mvp = document.getElementById('vp');
            mvp.setAttribute('content','width=450');
        }
    }
    </script>

    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/plugin/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/plugin/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 
    @yield('css')
        
    <title>@yield('title') - AppEntrega</title>
</head>
    
<body>

    <div class="container-fluid">
        @yield('content')  
    </div>

    @include('template.partials.footer')        
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.mask.min.js') }}"></script>
    @yield('script')
</body>
</html>
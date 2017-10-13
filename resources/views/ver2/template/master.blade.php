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
    <link rel="stylesheet" href="{{ url('css/ver2/main.css') }}">
    <link rel="stylesheet" href="{{ url('css/ver2/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/ver2/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/ver2/sidebar.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/ver2/animation.css') }}"/>
    <link rel="stylesheet" type="text/css" href="{{ url('css/ver2/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 
    @yield('css')
        
    <title>@yield('title') - AppEntrega</title>
</head>
    
<body>
    @include('ver2.template.partials.navbar')
    @include('ver2.template.partials.sidebar')        

    <div class="container-fluid">
        @yield('content')  
    </div>

    @include('ver2.template.partials.footer')        
    <script src="{{ url('js/jquery.min.js') }}"></script>
    <script src="{{ url('js/jquery.mask.min.js') }}"></script>
    <script src="{{ url('js/sidebar.js') }}"></script>
    @yield('script')
</body>
</html>
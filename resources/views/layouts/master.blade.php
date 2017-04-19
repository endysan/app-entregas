<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
        <!-- CSS -->
        <link rel="stylesheet" href="css/app.css">
        <link rel="stylesheet" href="css/main.css">
        
        @yield('css')
        
        <title>@yield('title')</title>
    </head>
    
<body>
    @include('layouts.nav')
        
        @yield('content')  
        
        
        @include('layouts.footer')
</body>
</html>
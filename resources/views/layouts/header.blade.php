<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- CSS -->
    <link rel="stylesheet" href="css/app.css">
    <link rel="stylesheet" href="css/main.css">
    
    @if ($title == 'Login')
    	<link rel="stylesheet" href="css/login.css">
    @elseif ($title == 'Cadastrar')
    	<link rel="stylesheet" href="css/cadastro.css">
	@elseif ($title == 'Editar Perfil')
	    <link rel="stylesheet" href="">
	
    @elseif ($title == 'Comprar Serviço')
        <link rel="stylesheet" href="css/checkout.css">
    @endif

    <title>{{ $title }} | AppEntrega</title>
</head>
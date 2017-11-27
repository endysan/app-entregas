<html>
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ url('css/plugin/bootstrap.min.css') }}"/>
    <link rel="stylesheet" href="{{ url('css/main.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('css/plugin/font-awesome.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet"> 
</head>
<body>
<style>
.input-group-addon {
    background-color: white;
    
}
.valor_div {
    width: 30%;
}
.valor_div * {
    font-size: 32px;
    color: #444;
}

</style>
<div class="container-fluid p-4">
    
    <h1 class="titulo">Propor orçamento</h1>
        
    <div class="align-items-center mt-4">
    <div class="col-auto valor_div">
      <label class="sr-only" for="valor">Username</label>
      <div class="input-group mb-2 mb-sm-0">
        <div class="input-group-addon">R$</div>
        <input type="text" class="form-control" id="valor" placeholder="00,00">
      </div>
    </div>
    <div class="col-auto mt-4">
      <button type="submit" class="btn btn-success">Enviar proposta</button>
    </div>
  </div>
</form>
    
</div>
<script src="{{ url('js/jquery.min.js') }}"></script>
<script src="{{ url('js/jquery.mask.min.js') }}"></script>
<script src="{{ url('js/sidebar.js') }}"></script>

<script>
$(document).ready(function(){
    $('#valor').mask('000.000.000.000.000,00', {reverse: true});
});
</script>
</body>
</html>
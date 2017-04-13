<?php 
    require_once("./connect.php");
    require_once("./_classes/Remetente.php");
    
    $hash_senha = password_hash($_POST['txt_senha'], PASSWORD_BCRYPT, array("cost" => 10));
    
    $nome = $_POST['txt_nome'];
    $email = $_POST['txt_email'];
    
    $real_nasc = str_replace('/', '-', $_POST['txt_dt_nasc']); //Troca para o formato padrao de data no MySQL
    $dt_nasc = DateTime::createFromFormat('d-m-Y', $real_nasc);
    $dt_nasc = $dt_nasc->format('Y-m-d');
    
    $telefone = $_POST['txt_telefone'];
    $whatsapp = $_POST['txt_whastapp'];
    
    $remetente = new Remetente($nome, $email, $hash_senha, $dt_nasc, $telefone, $whatsapp);

    $q = Connect::db_query($remetente->cadastrar_remetente());
    
    if($q === false) {
        echo '<h1>Auth: Houve um erro</h1>';
    }
    else {
        header ("location:login.html");
    }
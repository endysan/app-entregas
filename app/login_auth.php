<?php 
    require_once("./connect.php");
    require_once("./_classes/Remetente.php");
    
    $senha = $_POST['txt_senha'];
    $email = $_POST['txt_email'];
    
    $login = "SELECT email_remetente, senha_remetente FROM remetentes
              WHERE email_remetente = '$email';";
              
    $q = Connect::db_select($login);
    
    if($q === false) {
        echo '<h1>Auth: Houve um erro</h1>';
    }
    else {
        var_dump($q);
        if (password_verify($senha, $q[0]['senha_remetente']) === true){
            echo "<h1>Logado!</h1>";
        }
    }
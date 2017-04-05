<?php


    //require '../../config/db_config.php';
    $conn = mysqli_connect("localhost", "megaday", "");

    if($conn)
    {
        echo "<H1>Conn</h1>";
       $dtbs = "db_app_encomenda";
        
        $sqlc = "CREATE DATABASE IF NOT EXISTS ".$dtbs;
        
        if(mysqli_query($conn, $sqlc))
        {
            echo "<p>Database criado com sucesso</p>";
            
            mysqli_select_db($conn, $dtbs);
            
            mysqli_query($conn, "DROP TABLE remetentes");
            mysqli_query($conn, "DROP TABLE enderecos");
            mysqli_query($conn, "DROP TABLE entregadores");
            mysqli_query($conn, "DROP TABLE veiculos");
            mysqli_query($conn, "DROP TABLE entregas");
            mysqli_query($conn, "DROP TABLE produtos");
            mysqli_query($conn, "DROP TABLE pedidos");
            
            $sqlc = "CREATE TABLE remetentes(id_remetente int not null primary key auto_increment,
                    id_endereco int not null,
                    login_remetente varchar(20),
                    senha_remetente varchar(20),
                    nm_remetente varchar(50),
                    email_remetente varchar(50),
                    dt_nasc_remetente date,
                    telefone_remetente varchar(11),
                    whatsapp_remetente varchar(11),
                    endereco_remetente varchar(50))";
            
            if(mysqli_query($conn, $sqlc)) 
                echo "Tabela remetentes criada com sucesso<br>";
                
            $sqlc = "CREATE TABLE IF NOT EXISTS enderecos (
                    id_endereco int not null primary key auto_increment,
                    estado_endereco varchar(50),
                    cidade_endereco varchar(50),
                    bairro_endereco varchar(50))";
                   
            if(mysqli_query($conn, $sqlc)) 
                echo "Tabela enderecos criada com sucesso<br>";
                
            
        }
    }
    else echo mysqli_error();
?>
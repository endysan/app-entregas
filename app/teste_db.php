<html>
    <head>
        <title>Teste com banco</title>
        <meta charset="UTF-8">
    </head>
<?php
    require __DIR__."/config/db_config.php"; //Importante, possui as constantes do Banco
    echo "Ambiente do servidor: ".AMBIENTE;
    
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if($conn) {
        echo '<h3 color="green">Conexão estabelecida</h3>';
        
        if($result = mysqli_query($conn, "SELECT sysdate;")) {
            echo '<table><tr>';
            while ($row = $result->mysql_fetch_assoc()) {
                echo '<td>'.$row[0].'</td>';
            }
            echo '</tr></table>';
            $result->close();
        }
    }
    else echo mysqli_error();

    $query = null;
    $result = null;
    $conn = null;
?>
</html>
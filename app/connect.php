<?php 
require_once('./_config/db_config.php');

class Connect {
        
    protected static $db;

    /**
     * Cria uma conexão SQL
     * @return bool falso quando falhar / objeto mysqli em sucesso
    */
    public static function db_conn(){
        
        echo '<script>console.log("Criando conexão");</script>';
        if(!isset(self::$db)){
            
            self::$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);    
            
        }
        
        if(self::$db === false) {
             return mysqli_connect_error(); 
        }
        else {
            echo '<script>console.log("Criado!");</script>';
            return self::$db;
        }
    }   
    
    /**
     * @param query String da query que quer executar
     * Use esse método após chamar o @method db_conn
    */
    public static function db_query($query){
        $db = self::db_conn();
        
        $result = mysqli_query($db, $query);
        if ($result === false) {
            printf("\nErrormessage: %s\n", $db->error);
            return false;
        }
        else {
            echo '<script>console.log("Executando query");</script>';
        
            return $result;    
        }
    }
    
    public static function db_select($query) {
        $rows = array();
        $result = self::db_query($query);

        // Se falhar retorna `false`
        if($result === false) {
            return false;
        }

        // Se sucesso, retorna todas as linhas do Array
        while ($row = mysqli_fetch_assoc($result)) {
            $rows[] = $row;
        }
        return $rows;
    }
}
    
<?php
    require 'Cliente.php';
    
    class Entregador extends Cliente {
        private $veiculo; //objeto veiculo

        public function __construct(){
            //TODO
        }
        public function __get($value){
            return $this->value;
        }
        public function __set($name, $value){
            $this->$name = $value;
        }
    }
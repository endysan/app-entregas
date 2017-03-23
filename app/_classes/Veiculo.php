<?php
    class Veiculo {
        private $categoria; 
        private $descricao;

        public function __construct(){
            //TODO
        }
        public function __get($value){
            return $this->$value;
        }
        public function __set($name, $value){
            $this->$name = $value;
        }
    }
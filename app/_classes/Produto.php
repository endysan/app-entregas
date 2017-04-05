<?php
    class Produto {
        private $nome;
        private $descricao;
        private $categoria;
        private $foto;
        
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
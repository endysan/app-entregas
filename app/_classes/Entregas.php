<?php
    class Entregas {
        private $produto;
        private $dt_entrega;
        private $endereco_retirada;
        private $endereco_entrega;

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
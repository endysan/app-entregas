<?php
    class Endereco {
        private $estado;
        private $cidade;
        private $bairro;

        public function __get($value){
            return $this->$value;
        }

        public function __set($name, $value){
            return $this->$name = $value;
        }
    }
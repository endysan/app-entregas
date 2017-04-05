<?php
    class PedidoEntrega {
        private $entrega;
        private $remetente;
        private $entregador;

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
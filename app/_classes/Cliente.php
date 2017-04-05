<?php
    class Cliente {
        protected $nome;
        protected $email;
        protected $dt_nasc;
        protected $endereco; //objeto endereço
        protected $telefone;
        protected $whatsapp;

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
<?php
    require 'Cliente.php';
    
    class Remetente extends Cliente {
        
        public function __construct($nome, $email, $senha, $dt_nasc, $telefone, $whatsapp){
            $this->nome = $nome;
            $this->email = $email;
            $this->senha = $senha;
            $this->dt_nasc = $dt_nasc;
            $this->telefone = $telefone;
            $this->whatsapp = $whatsapp;
        }
        
        public function cadastrar_remetente(){
            return $query = strval("INSERT INTO remetentes (nm_remetente, email_remetente, senha_remetente, dt_nasc_remetente, telefone_remetente, whatsapp_remetente)".
                " VALUES ('$this->nome', '$this->email', '$this->senha', '$this->dt_nasc', '$this->telefone', '$this->whatsapp');");
        }
        public function criar_pedido(){
            //TODO
        }
    }
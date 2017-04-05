<?php
include __DIR__.'/app_config.php';

if(AMBIENTE === 'production') {
    //Produção
    define("DB_HOST", "br-cdbr-azure-south-b.cloudapp.net");
    define("DB_HOST_PORT", "3306");
    define("DB_NAME", "db_app_encomenda");
    define("DB_USER", "b1f5978a551b5a");
    define("DB_PASSWORD", "88f8db68");
} 
elseif (AMBIENTE === 'dev') {
    //Desenvolvimento/testes
    define("DB_HOST", "localhost");
    define("DB_HOST_PORT", "3306");
    define("DB_NAME", "db_app_encomenda");
    define("DB_USER", "megaday");
    define("DB_PASSWORD", "");
}
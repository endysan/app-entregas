<?php
include __DIR__.'/app_config.php';

if(AMBIENTE === 'production') {
    //Produção
    define("DB_HOST", "br-cdbr-azure-south-b.cloudapp.net");
    define("DB_HOST_PORT", "3306");
    define("DB_NAME", "db_app_entrega");
    define("DB_USER", "b919f2a62ef7b9");
    define("DB_PASSWORD", "ff7c071a");
} 
elseif (AMBIENTE === 'dev') {
    //Desenvolvimento/testes
    define("DB_HOST", "localhost");
    define("DB_HOST_PORT", "3306");
    define("DB_NAME", "db_app_entrega");
    define("DB_USER", "megaday");
    define("DB_PASSWORD", "");
}
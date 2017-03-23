CREATE DATABASE IF NOT EXISTS db_app_entrega;
USE db_app_entrega;

SET @@auto_increment_increment=1;

CREATE TABLE IF NOT EXISTS remetentes (
    id_remetente int not null primary key auto_increment,
    id_endereco int,
    nm_remetente varchar(50),
    email_remetente varchar(50),
    senha_remetente varchar(255),
    dt_nasc_remetente date,
    telefone_remetente varchar(13),
    whatsapp_remetente varchar(14),
    endereco_remetente varchar(50)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS enderecos (
    id_endereco int not null primary key auto_increment,
    estado_endereco varchar(50),
    cidade_endereco varchar(50),
    bairro_endereco varchar(50)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS entregadores (
    id_entregador int not null primary key auto_increment,
    id_endereco int,
    id_veiculo int,
    nm_entregador varchar(50),
    email_entregador varchar(50),
    senha_entregador varchar(255),
    dt_nasc_entregador date,
    telefone_entregador varchar(11),
    whatsapp_entregador varchar(11),
    endereco_entregador varchar(50)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS veiculos (
    id_veiculo int not null primary key auto_increment,
    categoria_veiculo varchar(20),
    descricao_veiculo varchar(140)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS produtos (
    id_produto int not null primary key auto_increment,
    titulo_produto varchar(50),
    categoria_produto varchar(20),
    descricao_produto varchar(140),
    foto_produto varchar(255)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS entregas (
    id_entrega int not null primary key auto_increment,
    id_produto int,
    dt_entrega date,
    endereco_retirada varchar(50),
    endereco_entrega varchar(50)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido int not null primary key auto_increment,
    id_remetente int,
    id_entrega int,
    id_entregador int,
    status_pedido varchar(20)
) auto_increment=1;

ALTER TABLE `remetentes` ADD FOREIGN KEY(`id_endereco`) REFERENCES `enderecos` (`id_endereco`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `entregadores` ADD FOREIGN KEY(`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `entregas` ADD FOREIGN KEY(`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_remetente`) REFERENCES `remetentes` (`id_remetente`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_entrega`) REFERENCES `entregas` (`id_entrega`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_entregador`) REFERENCES `entregadores` (`id_entregador`) ON DELETE SET NULL ON UPDATE CASCADE;
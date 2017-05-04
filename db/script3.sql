CREATE DATABASE IF NOT EXISTS db_app_entrega;
USE db_app_entrega;

SET @@auto_increment_increment=1;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario int not null primary key auto_increment,
    nome varchar(191),
    email varchar(191),
    password varchar(191),
    dt_nasc date,
    telefone varchar(191),
    whatsapp varchar(191,
    estado varchar(191),
    cidade varchar(191),
    bairro varchar(191)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS entregadores (
    id_entregador int not null primary key auto_increment,
    id_usuario int,
    cnh varchar(191), /* Provavelmente um link */
    status varchar(191)/* Aprovado, pode dirigir | Reprovado, não pode */
)

CREATE TABLE IF NOT EXISTS entregadores (
    id_entregador int not null primary key auto_increment,
    id_endereco int,
    id_veiculo int,
    nm_entregador varchar(191),
    email_entregador varchar(191),
    senha_entregador varchar(255),
    dt_nasc_entregador date,
    telefone_entregador varchar(191),
    whatsapp_entregador varchar(191),
    endereco_entregador varchar(191)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS veiculos (
    id_veiculo int not null primary key auto_increment,
    categoria_veiculo varchar(191),
) auto_increment=1;

CREATE TABLE IF NOT EXISTS produtos (
    id_produto int not null primary key auto_increment,
    titulo_produto varchar(191),
    categoria_produto varchar(191),
    descricao_produto varchar(191),
    foto_produto varchar(255)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS entregas (
    id_entrega int not null primary key auto_increment,
    id_produto int,
    dt_entrega date,
    endereco_retirada varchar(191),
    endereco_entrega varchar(191)
) auto_increment=1;

CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido int not null primary key auto_increment,
    id_remetente int,
    id_entrega int,
    id_entregador int,
    status_pedido varchar(191)
) auto_increment=1;

ALTER TABLE `remetentes` ADD FOREIGN KEY(`id_endereco`) REFERENCES `enderecos` (`id_endereco`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `entregadores` ADD FOREIGN KEY(`id_veiculo`) REFERENCES `veiculos` (`id_veiculo`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `entregas` ADD FOREIGN KEY(`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_remetente`) REFERENCES `remetentes` (`id_remetente`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_entrega`) REFERENCES `entregas` (`id_entrega`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_entregador`) REFERENCES `entregadores` (`id_entregador`) ON DELETE SET NULL ON UPDATE CASCADE;
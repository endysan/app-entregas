CREATE DATABASE IF NOT EXISTS db_app_entrega;
USE db_app_entrega;

SET @@auto_increment_increment=1;

CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario int not null primary key auto_increment,
    nome varchar(50),
    email varchar(50),
    password varchar(255),
    dt_nasc date,
    telefone varchar(13),
    whatsapp varchar(14),
    estado varchar(191),
    cidade varchar(191),
    bairro varchar(191)
) auto_increment=1;


CREATE TABLE IF NOT EXISTS entregadores (
    id_entregador int not null primary key auto_increment,
    id_usuario int,
    cnh varchar(191), /* Provavelmente um link */
    status varchar(191),/* Aprovado, pode dirigir | Reprovado, não pode */
    categoria_veiculo varchar(20),
    descricao_veiculo varchar(140)
) auto_increment=1;


CREATE TABLE IF NOT EXISTS pedidos (
    id_pedido int not null primary key auto_increment,
    id_usuario int,
    id_entregador int,
    titulo_produto varchar(50),
    categoria_produto varchar(20),
    descricao_produto varchar(140),
    foto_produto varchar(255),
	dt_entrega date,
    endereco_retirada varchar(50),
    endereco_entrega varchar(50),
    status_pedido varchar(20)
) auto_increment=1;

ALTER TABLE `entregadores` ADD FOREIGN KEY(`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE SET NULL ON UPDATE CASCADE;
ALTER TABLE `pedidos` ADD FOREIGN KEY(`id_entregador`) REFERENCES `entregadores` (`id_entregador`) ON DELETE SET NULL ON UPDATE CASCADE;
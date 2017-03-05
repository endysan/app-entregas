CREATE DATABASE IF NOT EXISTS app_entrega;
USE app_entrega;

CREATE TABLE IF NOT EXISTS remetente (
    id_remetente int not null primary key auto_increment,
    id_endereco int not null,
    login_remetente varchar(20),
    senha_remetente varchar(20),
    nm_remetente varchar(50),
    email_remetente varchar(50),
    dt_nasc_remetente date,
    telefone_remetente varchar(11),
    whatsapp_remetente varchar(11),
    endereco_remetente varchar(50),
    constraint fk_endereco foreign key(id_endereco)
);

CREATE TABLE IF NOT EXISTS endereco (
    id_endereco int not null primary key auto_increment,
    estado_endereco varchar(50),
    cidade_endereco varchar(50),
    bairro_endereco varchar(50)
);

CREATE TABLE IF NOT EXISTS entregador (
    id_entregador int not null primary key auto_increment,
    id_endereco int not null,
    id_veiculo int not null,
    login_entregador varchar(20),
    senha_entregador varchar(20),
    nm_entregador varchar(50),
    email_entregador varchar(50),
    dt_nasc_entregador date,
    telefone_entregador varchar(11),
    whatsapp_entregador varchar(11),
    endereco_entregador varchar(50),
    constraint fk_veiculo foreign key(id_veiculo)
);

CREATE TABLE IF NOT EXISTS veiculo (
    id_veiculo int not null primary key auto_increment,
    categoria_veiculo varchar(20),
    descricao_veiculo varchar(140)
);

CREATE TABLE IF NOT EXISTS produto (
    id_produto int not null primary key auto_increment,
    titulo_produto varchar(50),
    categoria_produto varchar(20),
    descricao_produto varchar(140),
    foto_produto varchar(255)
);

CREATE TABLE IF NOT EXISTS entrega (
    id_entrega int not null primary key auto_increment,
    id_produto int not null,
    constraint fk_produto foreign key(id_produto),
    dt_entrega date,
    endereco_retirada varchar(50),
    endereco_entrega varchar(50)
);

CREATE TABLE IF NOT EXISTS pedido (
    id_pedidos int not null primary key auto_increment,
    id_remetente int not null,
    id_entrega int not null,
    id_entregador int not null,
    status_pedidos varchar(20),
    constraint fk_remetente foreign key(id_remetente),
    constraint fk_entrega foreign key(id_entrega),
    constraint fk_entregador foreign key(id_entregador)
);
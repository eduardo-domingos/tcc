CREATE DATABASE IF NOT EXISTS wc;
USE wc;

CREATE TABLE IF NOT EXISTS usuarios(
    id_usuario int primary key auto_increment,
    nome varchar(50) not null,
    email varchar(50) not null,
    numero varchar(15) not null,
    cpf_cnpj varchar(18) not null unique,
    senha char(40) not null,
    flag varchar(15) not null /* jurídica ou física*/
);

CREATE TABLE IF NOT EXISTS projetos(
    id_projeto int auto_increment primary key,
    id_usuario int not null,
    foreign key (id_usuario) references usuarios(id_usuario),
    titulo varchar(50) not null,
    equipe text not null,
    resumo text not null,
    caracteristicas text not null,
    localidade varchar(80) not null,
    data_inicio date,
    video char(11),
    imagem varchar(50) not null,
    valor decimal(10,2)
);

CREATE TABLE IF NOT EXISTS admins(
    id_admin int auto_increment primary key,
    nome varchar(30) not null,
    email varchar(80) not null,
    senha char(40) not null
);

CREATE TABLE IF NOT EXISTS comentarios(
    id_comentario int auto_increment primary key,
    id_usuario int,
    id_projeto int,
    nome varchar(50) not null,
    foreign key (id_projeto) references projetos(id_projeto),
    foreign key (id_usuario) references usuarios(id_usuario),
    comentario text,
    data_coment date NOT NULL 
);

CREATE TABLE IF NOT EXISTS financiamentos(
    id_financiamento int auto_increment primary key,
    id_usuario int,
    id_projeto int,
    foreign key (id_projeto) references projetos(id_projeto),
    foreign key (id_usuario) references usuarios(id_usuario),
    financiar char(3) not null,
    quantidade_vezes int,
    data_financ date
);

CREATE TABLE IF NOT EXISTS likes(
    id_like int auto_increment primary key,
    id_projeto int,
    foreign key (id_projeto) references projetos(id_projeto),
    id_usuario int,
    foreign key (id_usuario) references usuarios(id_usuario),
    curtiu char(3),
    pontos int
);

/* Inserindo daddos na tabela admin*/
insert into admins(nome, email, senha) values( "admin",  "admin@gmail.com", sha1("admin"));
create database portal;
use portal;
create table noticias(id bigint auto_increment primary key,nome varchar(100) not null,descricao varchar(600),data_publicacao timestamp default current_timestamp);
alter table noticias add column status char(10) enum('PUBLICADO','PRIVADO');
create table usuarios(username varchar(100) not null  primary_key,senha varchar(100)  not null,data_cadastro timestamp default current_timestamp);

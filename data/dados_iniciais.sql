create database portal;
use portal;
create table noticias(id bigint auto_increment primary key,nome varchar(100) not null,descricao varchar(600),data_publicacao timestamp default current_timestamp);
alter table noticias add column status  enum('PUBLICADO','PRIVADO');
create table usuarios(username varchar(100) not null  primary key,senha varchar(100)  not null,data_cadastro timestamp default current_timestamp);


insert into usuarios values('admin','1234',NOW());

create database quadrado;
use quadrado;
create table quadrados (
    id int primary key auto_increment,
    lado varchar(250),
    cor varchar(250),
    id_un int,
    foreign key (id_un) references unidademedida(id) );
    
create table unidademedida(
    id int primary key auto_increment,
    unidade varchar(3));
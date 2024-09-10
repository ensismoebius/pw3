create database aula02;

use aula02;

create table funcionario (
    id int primary key auto_increment, 
    nome varchar(255), 
    sobrenome varchar(255)
    );

insert into funcionario (nome, sobrenome) values 
("Carla","Caverna"),
("Maguila","Uga");
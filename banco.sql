DROP IF EXISTS DATABASE RU;
CREATE DATABASE RU;
USE RU;
CREATE TABLE itens (id int, nome VARCHAR (120), primary key(id)); /*Foreign key para os ingredientes*/
CREATE TABLE ingredientes (id int AUTO_INCREMENT NOT NULL, descricao VARCHAR(120) NOT NULL, calorias float NOT NULL, primary key (id));
CREATE TABLE itens_ingredientes (id_)
CREATE TABLE nutricionistas (nome VARCHAR (120) NOT NULL, crn varchar(50) NOT NULL, primary key (crn));
CREATE TABLE usuarios (nome VARCHAR (120) NOT NULL, email VARCHAR (200) NOT NULL, senha VARCHAR (80) NOT NULL, id INT AUTO_INCREMENT NOT NULL, primary key (id));
CREATE TABLE cardapios (nutricionista, dia data, tipo int, FOREIGN KEY (nutricionista) REFERENCES NUTRICIONISTA(nome));
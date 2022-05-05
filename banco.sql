DROP IF EXISTS DATABASE RU;
CREATE DATABASE RU;
USE RU;
CREATE TABLE itens (
    id int AUTO_INCREMENT NOT NULL,
    descricao VARCHAR (120) NOT NULL,
    primary key(id)
);
CREATE TABLE ingredientes (
    id int AUTO_INCREMENT NOT NULL,
    descricao VARCHAR(120) NOT NULL,
    calorias float NOT NULL,
    primary key (id)
);
CREATE TABLE itens_ingredientes (
    id_item int NOT NULL,
    id_ingrediente int NOT NULL,
    FOREIGN KEY id_item REFERENCES itens(id),
    FOREIGN KEY id_ingrediente REFERENCES ingredientes(id),
    PRIMARY KEY (id_item, id_ingrediente)
);
CREATE TABLE itens_cardapios (
    id_item int NOT NULL,
    id_cardapio int NOT NULL,
    FOREIGN KEY id_item REFERENCES itens(id),
    FOREIGN KEY id_cardapio REFERENCES cardapios(id),
    PRIMARY KEY (id_item, id_cardapio)
)
CREATE TABLE nutricionistas (
    crn varchar(10) NOT NULL,
    nome VARCHAR (120) NOT NULL,
    PRIMARY KEY (crn)
);
CREATE TABLE usuarios (
    id int AUTO_INCREMENT NOT NULL,
    nome VARCHAR (120) NOT NULL,
    email VARCHAR (200) NOT NULL,
    senha VARCHAR (80) NOT NULL,
    primary key (id)
);
CREATE TABLE cardapios (
    id int AUTO_INCREMENT NOT NULL,
    dia data NOT NULL,
    tipo int NOT NULL,
    crn_nutricionista VARCHAR (10) NOT NULL,
    FOREIGN KEY (crn_nutricionista) REFERENCES nutricionistas(crn)
);
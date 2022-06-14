DROP DATABASE RU;
CREATE DATABASE RU;
USE RU;
CREATE TABLE itens (
	id int AUTO_INCREMENT NOT NULL,
    descricao varchar(120) NOT NULL,
    calorias_totais int NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE ingredientes (
	id int AUTO_INCREMENT NOT NULL,
    descricao varchar(120) NOT NULL,
    calorias float NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE itens_ingredientes (
	id_item int NOT NULL,
    id_ingrediente int NOT NULL,
    FOREIGN KEY (id_item) REFERENCES itens(id),
    FOREIGN KEY (id_ingrediente) REFERENCES ingredientes(id),
    PRIMARY KEY (id_item, id_ingrediente)
);
CREATE TABLE nutricionistas (
    id int AUTO_INCREMENT NOT NULL,
	crn varchar(10) NOT NULL,
    nome varchar (120) NOT NULL,
    PRIMARY KEY (id)
);
CREATE TABLE cardapios (
	id int AUTO_INCREMENT NOT NULL,
    `data` DATE NOT NULL,
    tipo int NOT NULL,
    id_nutricionista INT NOT NULL,
    FOREIGN KEY (id_nutricionista) REFERENCES nutricionistas(id),
    PRIMARY KEY (id)
);
CREATE TABLE itens_cardapios (
	id_item int NOT NULL,
    id_cardapio int NOT NULL,
    FOREIGN KEY (id_item) REFERENCES itens(id),
    FOREIGN KEY (id_cardapio) REFERENCES cardapios(id),
    PRIMARY KEY (id_item, id_cardapio)
);
CREATE TABLE nutricionistas_cardapios (
	id_nutricionista int NOT NULL,
    id_cardapio int NOT NULL,
    FOREIGN KEY (id_nutricionista) REFERENCES nutricionistas(id),
    FOREIGN KEY (id_cardapio) REFERENCES cardapios(id),
    PRIMARY KEY (id_nutricionista, id_cardapio)
);
CREATE TABLE usuarios (
	id int AUTO_INCREMENT NOT NULL,
    nome varchar (120) NOT NULL,
    email varchar(200) NOT NULL,
    senha varchar (80) NOT NULL,
    PRIMARY KEY (id)
);
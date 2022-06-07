DROP DATABASE RU;
CREATE DATABASE RU;
USE RU;
CREATE TABLE itens (
	id int AUTO_INCREMENT NOT NULL,
    descricao varchar(120) NOT NULL,
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
	crn varchar(10) NOT NULL,
    nome varchar (120) NOT NULL,
    PRIMARY KEY (crn)
);
CREATE TABLE cardapios (
	id int AUTO_INCREMENT NOT NULL,
    dia DATE NOT NULL,
    tipo int NOT NULL,
    crn_nutricionista varchar(10) NOT NULL,
    FOREIGN KEY (crn_nutricionista) REFERENCES nutricionistas(crn),
    PRIMARY KEY (id)
);
CREATE TABLE itens_cardapios (
	id_item int NOT NULL,
    id_cardapio int NOT NULL,
    FOREIGN KEY (id_item) REFERENCES itens(id),
    FOREIGN KEY (id_cardapio) REFERENCES cardapios(id),
    PRIMARY KEY (id_item, id_cardapio)
);
CREATE TABLE usuarios (
	id int AUTO_INCREMENT NOT NULL,
    nome varchar (120) NOT NULL,
    email varchar(200) NOT NULL,
    senha varchar (80) NOT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE refeicao (
    dia_cardapio DATE NOT NULL,
    tipo_cardapio int NOT NULL,
    descricao_itens varchar(120) NOT NULL,
    FOREIGN KEY (dia_cardapio) REFERENCES cardapios(dia),
    FOREIGN KEY (tipo_cardapio) REFERENCES cardapios(tipo),
    FOREIGN KEY (descricao_itens) REFERENCES itens(descricao)
);

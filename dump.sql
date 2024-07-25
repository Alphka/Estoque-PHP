CREATE DATABASE IF NOT EXISTS estoque;
USE estoque;

DROP TABLE IF EXISTS categoria;
CREATE TABLE categoria (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome text
);

INSERT INTO categoria (nome) VALUES
	("Acessórios"),
	("Periféricos"),
	("Software"),
	("Mouse Gamer"),
	("Adaptadores"),
	("Cabos"),
	("Placas"),
	("Cursos");

DROP TABLE IF EXISTS estoque;
CREATE TABLE estoque (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome text,
	numero int,
	categoria text,
	quantidade int,
	fornecedor text
);

INSERT INTO estoque (numero, nome, categoria, quantidade, fornecedor) VALUES
	(192283, "Teclado RAZR CABUNTEM 230", "Acessórios", 32, "MH TECH"),
	(62828, "Teclado Burning 2", "Periféricos", 50, "Oderço Distribuidora"),
	(999252, "Windows 10 PRO", "Software", 10, "Oderço Distribuidora"),
	(1818282, "Ableton Live 10", "Software", 2, "Oderço Distribuidora"),
	(19967, "Curso de PHP Avançado", "Cursos", 999, "FILIPAK Cursos"),
	(82265, "Curso de PHP Basico", "Cursos", 78, "FILIPAK Cursos");

DROP TABLE IF EXISTS fornecedor;
CREATE TABLE fornecedor (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome text
);

INSERT INTO fornecedor (nome) VALUES
	("MH TECH"),
	("FILIPAK Cursos"),
	("Palimontes Informática"),
	("Casas Bahia"),
	("Oderço Distribuidora");

DROP TABLE IF EXISTS usuarios;
CREATE TABLE usuarios (
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	nome text,
	email text,
	senha text,
	nivel int,
	status text
);

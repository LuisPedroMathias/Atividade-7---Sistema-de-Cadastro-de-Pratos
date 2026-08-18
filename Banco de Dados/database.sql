CREATE DATABASE sistema_pratos_LandP;
USE sistema_pratos_LandP;

CREATE TABLE usuarios (
    nome VARCHAR(200) AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE pratos (
    idprato INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao LONGTEXT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    nome_user VARCHAR(200) NOT NULL,
    FOREIGN KEY (nome_user) REFERENCES usuarios(nome)
);

CREATE DATABASE sistema_pratos_LandP;
USE sistema_pratos_LandP;

CREATE TABLE usuarios (
    iduser INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE pratos (
    idprato INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(200) NOT NULL,
    descricao LONGTEXT NOT NULL,
    preco DECIMAL(10, 2) NOT NULL,
    categoria VARCHAR(100) NOT NULL,
    iduser INT NOT NULL,
    FOREIGN KEY (iduser) REFERENCES usuarios(iduser)
);

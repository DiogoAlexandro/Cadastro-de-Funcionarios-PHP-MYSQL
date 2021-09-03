CREATE DATABASE empresa DEFAULT CHARACTER SET utf8 DEFAULT COLLATE utf8_general_ci;
USE empresa;

CREATE TABLE admin (
    `id` INT NOT NULL AUTO_INCREMENT,
    `username` VARCHAR(45) NOT NULL,
	`passcode` VARCHAR(45) NOT NULL,
    PRIMARY KEY (id));
    INSERT INTO admin  VALUES (1,"diogo","diogo") ;

CREATE TABLE funcionarios (
    `id` INT NOT NULL AUTO_INCREMENT,
    `nome` VARCHAR(45) NOT NULL,
	`email` VARCHAR(45) NOT NULL,
    `telefone` VARCHAR(45) NOT NULL,
    `celular` VARCHAR(45) NOT NULL,
    `cidade` VARCHAR(45) NOT NULL,
    `nascimento` DATE NOT NULL,
    `salario` VARCHAR(45) NOT NULL,
    `datacriacao` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`datamodificacao` TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY(id)
);

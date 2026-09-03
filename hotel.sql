CREATE DATABASE hotel 
CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci; 
USE hotel; 

CREATE TABLE usuario ( 
id_usuario INT PRIMARY KEY AUTO_INCREMENT, 
nome VARCHAR(100) NOT NULL, 
login VARCHAR(50) NOT NULL UNIQUE,
 senha VARCHAR(255) NOT NULL,    
perfil VARCHAR(30) 
 ); 

CREATE TABLE hospede(
 id_hospede INT PRIMARY KEY AUTO_INCREMENT,   
 nome VARCHAR(100) NOT NULL,     
 cpf VARCHAR(14) NOT NULL UNIQUE,    
 telefone VARCHAR(20),     
 email VARCHAR(100),     
 endereco VARCHAR(150) 
 ); 
 
CREATE TABLE quarto (   
   id_quarto INT PRIMARY KEY AUTO_INCREMENT,   
   numero VARCHAR(10) NOT NULL UNIQUE,    
   tipo VARCHAR(50) NOT NULL,   
   capacidade INT NOT NULL,   
   valor_diaria DECIMAL(10,2) NOT NULL,   
   status VARCHAR(20) DEFAULT 'Disponível' 
   ); 
   
   CREATE TABLE reserva (    
   id_reserva INT PRIMARY KEY AUTO_INCREMENT,    
   id_hospede INT NOT NULL,     
   id_quarto INT NOT NULL,   
   data_entrada DATE NOT NULL,  
   data_saida DATE NOT NULL,   
   status VARCHAR(30) DEFAULT 'Reservada',   
   FOREIGN KEY (id_hospede)     REFERENCES hospede(id_hospede),  
   FOREIGN KEY (id_quarto)     REFERENCES quarto(id_quarto) 
   ); 
   
   INSERT INTO hospede (nome, cpf, telefone, email, endereco) VALUES
   ('Carlos Silva', '111.111.111-11', '21999990001', 'carlos@email.com', 'Rio de Janeiro'), 
   ('Maria Souza', '222.222.222-22', '21999990002', 'maria@email.com', 'Niterói'),
   ('Pedro Santos', '333.333.333-33', '21999990003', 'pedro@email.com', 'Duque de Caxias'); 
   
   INSERT INTO quarto (numero, tipo, capacidade, valor_diaria, status) VALUES 
   ('101','Standard',2,180,'Disponível'), 
   ('102','Standard',2,180,'Disponível'), 
   ('103','Luxo',2,250,'Disponível'), 
   ('104','Luxo',3,280,'Disponível'),
   ('201','Suíte',2,350,'Disponível'),
   ('202','Suíte',2,350,'Disponível'), 
   ('203','Executivo',2,400,'Disponível'), 
   ('204','Executivo',3,450,'Disponível'),
   ('301','Suíte Master',4,600,'Disponível'), 
   ('302','Suíte Master',4,600,'Manutenção'); 
   
 
   SELECT * FROM quarto WHERE status = 'Disponível' ORDER BY numero; 
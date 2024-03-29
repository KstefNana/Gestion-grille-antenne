﻿
-- GRANT ALL PRIVILEGES ON *.* TO 'php' @'localhost' IDENTIFIED BY '123456' WITH GRANT OPTION;
-- GRANT ALL PRIVILEGES ON *.* TO 'php' @'%' IDENTIFIED BY '123456' WITH GRANT OPTION;

DROP DATABASE IF EXISTS ges_stag;
USE gestion_grillecrtv;


CREATE TABLE UTILISATEUR (
	ID int(4) AUTO_INCREMENT PRIMARY KEY,
	LOGIN VARCHAR(100) NOT NULL,
	PWD VARCHAR(255) NOT NULL,
	ROLE VARCHAR(50),
	EMAIL VARCHAR(255),
	ETAT INT(1)); 
-- 	ETAT = 0 désactivé
-- 	ETAT = 1 activé
		
CREATE TABLE STAGIAIRE (
	ID int(4) AUTO_INCREMENT PRIMARY KEY,
	NOM VARCHAR(50) NOT NULL,
	PRENOM VARCHAR(50) NOT NULL,
	ID_FILIERE int(4),
	PHOTO VARCHAR(50),
	CIVILITE VARCHAR(1),
	FRAIS_INSCRIPTION DOUBLE,
	FRAIS_MOIS DOUBLE,
	FRAIS_EXAMEN DOUBLE,
	FRAIS_DIPLOME DOUBLE);

CREATE TABLE FILIERE (                    
	ID int(4) AUTO_INCREMENT PRIMARY KEY, 
	NOM_FILIERE VARCHAR(100) NOT NULL,    
	NIVEAU VARCHAR(100) NOT NULL); 
	
ALTER TABLE STAGIAIRE ADD constraint fk10 foreign key(ID_FILIERE) references FILIERE(ID);

INSERT INTO FILIERE(NOM_FILIERE,NIVEAU) VALUES
	('TSDI','TS'),
	('TSGE','TS'),
	('TGI','T'),
	('TSRI','TS'),
	('TSMI','TS'),
	('TCE','T');	
	
	
INSERT INTO UTILISATEUR VALUES 
	(1,'admin',md5('123'),'ADMIN','lahcenabousalih@gmail.com',1),
	(2,'user1',md5('123'),'VISITEUR','user1@gmail.com',1),
	(3,'user2',md5('123'),'VISITEUR','user2@gmail.com',1);	

INSERT INTO STAGIAIRE(NOM,PRENOM,ID_FILIERE,PHOTO,CIVILITE,FRAIS_INSCRIPTION,FRAIS_MOIS,FRAIS_EXAMEN,FRAIS_DIPLOME) VALUES
('SAADAOUI','MOHAMMED',1,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',2,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',3,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',4,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',5,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',6,'user_green.png','M',500,500,500,500),	
('SAADAOUI','MOHAMMED',2,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',3,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',4,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',5,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',6,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',1,'user_green.png','M',500,500,500,500),	
('SAADAOUI','MOHAMMED',3,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',4,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',5,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',6,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',1,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',2,'user_green.png','M',500,500,500,500),	
('SAADAOUI','MOHAMMED',4,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',5,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',6,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',1,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',2,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',3,'user_green.png','M',500,500,500,500),	
('SAADAOUI','MOHAMMED',5,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',6,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',1,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',2,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',3,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',4,'user_green.png','M',500,500,500,500),
('SAADAOUI','MOHAMMED',6,'User.png','M',500,500,500,500),
	('CHKIRI','OMAR',1,'user_green.png','M',500,500,500,500),
	('SLIMANI','RACHIDA',2,'User.png','F',500,450,500,500),
	('FAOUZI','NABILA',3,'user_green.png','F',500,500,500,500),
	('ETTAOUSSI','KAMAL',4,'User.png','M',500,450,500,500),
	('EZZAKI','ABDELKARIM',5,'user_green.png','M',500,500,500,500);	

SELECT * FROM FILIERE;
SELECT * FROM STAGIAIRE;
SELECT * FROM UTILISATEUR;
				
-- SAUVGARDER UNE BASE DE DONNEE MYSQL
-- ouvrez l'invite de commande cmd
-- mysqldump -u root -p ges_stag > ges_stag.sql				
 
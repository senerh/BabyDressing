drop table if exists Produit;
drop table if exists Categorie;
drop table if exists Panier;
drop table if exists Utilisateur;

#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------
CREATE TABLE Produit(
        prod_id          int (11) Auto_increment  NOT NULL ,
        prod_title       Varchar (100) NOT NULL ,
        prod_image       Varchar (200) NOT NULL ,
        prod_description Varchar (2000) NOT NULL ,
        prod_prix        Float NOT NULL ,
        user_id          Int NOT NULL ,
        cat_id           Int NOT NULL ,
        PRIMARY KEY (prod_id )
)ENGINE=InnoDB;

CREATE TABLE Utilisateur(
        user_id int(11) NOT NULL auto_increment,
		user_nom varchar(50) not null,
		user_prenom varchar(50) not null,
		user_username varchar(100) not null,
		user_password varchar(88) not null,
		user_salt varchar(23) not null,
		user_role varchar(50) not null,
		user_numero int(11),
		user_rue varchar(100),
		user_codePostal int(15),
		user_ville varchar(50),
		user_telephone int(10),
		
		UNIQUE (user_username),
		PRIMARY KEY (user_id)
)ENGINE=InnoDB;


CREATE TABLE Categorie(
        cat_id  int (11) Auto_increment  NOT NULL ,
        cat_nom Varchar (25) NOT NULL ,
        PRIMARY KEY (cat_id )
)ENGINE=InnoDB;


CREATE TABLE Panier(
        prod_id Int NOT NULL ,
        user_id Int NOT NULL ,
        PRIMARY KEY (prod_id ,user_id )
)ENGINE=InnoDB;

CREATE TABLE Achat(
        user_id	int (11) NOT NULL,
        achat_date date NOT NULL, 
    	achat_total	float (11) NOT NULL
)ENGINE=InnoDB;

ALTER TABLE Produit ADD CONSTRAINT FK_Produit_user_id FOREIGN KEY (user_id) REFERENCES Utilisateur(user_id);
ALTER TABLE Produit ADD CONSTRAINT FK_Produit_cat_id FOREIGN KEY (cat_id) REFERENCES Categorie(cat_id);
ALTER TABLE Panier ADD CONSTRAINT FK_Panier_prod_id FOREIGN KEY (prod_id) REFERENCES Produit(prod_id);
ALTER TABLE Panier ADD CONSTRAINT FK_Panier_user_id FOREIGN KEY (user_id) REFERENCES Utilisateur(user_id);
ALTER TABLE Achat ADD CONSTRAINT FK_Achat_user_id FOREIGN KEY (user_id) REFERENCES Utilisateur(user_id);

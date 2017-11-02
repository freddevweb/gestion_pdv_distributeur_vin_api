DROP DATABASE IF EXISTS vendors;

CREATE DATABASE IF NOT EXISTS vendors;

USE vendors;

-- ###########################################################
-- ###########################################################

CREATE TABLE vendor (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) UNIQUE NOT NULL,
    pass varchar(255) NOT NULL 

)engine=innodb;

CREATE TABLE vendorWine (
	vendorId INT NOT null,
	wineId INT NOT NULL

)engine=innodb;

CREATE TABLE category (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL

)engine=innodb;

CREATE TABLE wine (
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	color VARCHAR(255) NOT NULL,
	year INT NOT NULL,
	designation VARCHAR(255) NOT NULL,
	categoryId INT NOT NULL

)engine=innodb;

-- ###########################################################
-- ###########################################################

ALTER TABLE wine
	ADD CONSTRAINT FK_wine_category
	FOREIGN KEY (categoryId) 
	REFERENCES category(id);

ALTER TABLE vendorWine
	ADD CONSTRAINT FK_vendor_vendorWine
	FOREIGN KEY (vendorId) 
	REFERENCES vendor(id);

ALTER TABLE vendorWine
	ADD CONSTRAINT FK_wine_vendorWine
	FOREIGN KEY (wineId) 
	REFERENCES wine(id);

ALTER TABLE vendorWine
	ADD CONSTRAINT PK_wine_category
	PRIMARY KEY (vendorId , wineId );

-- ###########################################################
-- ###########################################################

INSERT INTO vendor VALUES
( 1 , "paul" , "paul" ),
( 2 , "pierre" , "pierre"  ),
( 3 , "francois" , "francois"  ),
( 4 , "fred" , "fred"  )
;

INSERT INTO category VALUES 
( 1 , "red" ),
( 2 , "pink" ),
( 3 , "white" )
;

INSERT INTO  wine VALUES
( 1 , "les marguerites" , "white" , 2007 , "aop cotes du roussillon" , 3 ),
( 2 , "les lilas" , "red" , 2007 , "aop cotes du roussillon" , 1 ),
( 3 , "mimosas" , "pink" , 2007 , "aop cotes du roussillon" , 2 ),
( 4 , "les charues" , "red" , 2007 , "aop cotes du roussillon" , 1 ),
( 5 , "le rose du matin" , "pink" , 2007 , "aop cotes du roussillon" , 2 ),
( 6 , "gris des sables" , "red" , 2007 , "aop cotes du roussillon" , 1 ),
( 7 , "rivesalte maury" , "white" , 2007 , "aop cotes du roussillon" , 3 )
;

INSERT INTO  vendorWine VALUES
( 1 , 2 ),
( 1 , 4 ),
( 1 , 6 ),
( 1 , 7 ),
( 2 , 1 ),
( 2 , 2 ),
( 2 , 4 ),
( 2 , 6 ),
( 3 , 1 ),
( 3 , 3 ),
( 3 , 4 ),
( 3 , 7 ),
( 4 , 1 ),
( 4 , 3 ),
( 4 , 5 ),
( 4 , 6 )
;
/*
use vendors;

select * from wine as w
	inner join vendorWine as vw on vw.wineId = w.id
where vw.vendorId = 4;

delete from vendorWine where wineId = 7 and vendorId = 4;


*/



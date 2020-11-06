--
-- base de donn�es: 'database_address_book'
--
create database if not exists database_address_book default character set utf8 collate utf8_general_ci;
use database_address_book;
-- --------------------------------------------------------
-- creation des tables

set foreign_key_checks =0;

-- table user
drop table if exists user;
create table user (
	user_id int not null auto_increment primary key,
	user_lastname VARCHAR(50) NOT NULL,
	user_firstname VARCHAR(50) NOT NULL,
	user_email VARCHAR(250) UNIQUE NOT NULL,
	user_username VARCHAR(250) UNIQUE NOT NULL,
	user_password VARCHAR(250) NOT NULL,
	user_role VARCHAR(50) NOT NULL,
	user_createdat DATETIME NOT NULL
)engine=innodb;

-- table contact
drop table if exists contact;
create table contact (
	contact_id int not null auto_increment primary key,
	contact_lastname VARCHAR(100) NOT NULL,
	contact_firstname VARCHAR(100) NOT NULL,
	contact_photo VARCHAR(100),
	contact_description TEXT,
	contact_birth DATE,
	contact_postaladdress VARCHAR(200),
	contact_postalcode INT,
	contact_city VARCHAR(50),
	contact_email VARCHAR(100),
	contact_telephone VARCHAR(100),
	contact_mobile VARCHAR(100),
	contact_createdat DATETIME NOT NULL,
	contact_user INT NOT NULL
)engine=innodb;

set foreign_key_checks =1;

-- contraintes
alter table contact add constraint cs1 foreign key (contact_user) references user(user_id);
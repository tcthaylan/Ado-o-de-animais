create database animal_adoption
default character set utf8
default collate utf8_general_ci;

use animal_adoption;

create table user (
	id_user int primary key auto_increment,
    name varchar(100) not null,
    last_name varchar(100) not null,
    email varchar(100) not null,
    password varchar(32) not null,
    token varchar(32) null
)default charset = utf8;

create table phone (
	id_phone int primary key auto_increment,
    id_user int not null,
    phone varchar(50) null,
    cell_phone varchar(50) null
)default charset = utf8;

create table userToken (
	id_token int primary key auto_increment,
    id_user int not null,
    hash varchar(32) not null,
    expires_in date not null,
    used tinyint not null default 0
)default charset = utf8;

create table federativeUnit (
	uf char(2) primary key,
    state_name varchar(100) not null
)default charset = utf8;

insert into federativeUnit (uf, state_name) values 
('AC', 'Acre'),
('AL', 'Alagoas'),
('AP', 'Amapá'),
('AM', 'Amazonas'),
('BA', 'Bahia'),
('CE', 'Ceará'),
('DF', 'Distrito Federal'),
('ES', 'Espírito Santo'),
('GO', 'Goiás'),
('MA', 'Maranhão'),
('MT', 'Mato Grosso'),
('MS', 'Mato Grosso do Sul'),
('MG', 'Minas Gerais'),
('PA', 'Pará'),
('PB', 'Paraíba'),
('PR', 'Paraná'),
('PE', 'Pernambuco'),
('PI', 'Piauí'),
('RJ', 'Rio de Janeiro'),
('RN', 'Rio Grande do Norte'),
('RS', 'Rio Grande do Sul'),
('RO', 'Rondônia'),
('SC', 'Santa Catarina'),
('SP', 'São Paulo'),
('SE', 'Sergipe'),
('TO', 'Tocantins');

create table userAddress (
	id_user_address int primary key auto_increment,
    id_user int,
    uf char(2) not null,
    city varchar(100) not null
)default charset = utf8;

create table animalAddress (
	id_address_animal int primary key auto_increment,
    id_animal int,
    uf char(2) not null,
    city varchar(100) not null
)default charset = utf8;

create table animal (
	id_animal int primary key auto_increment,
    id_specie int not null,
    id_size int not null,
    id_user int not null,
    id_breed int not null,
    name varchar(100) not null, 
    gender char(1) not null,
    description text null,
    birth_date date null,
    status tinyint(1) not null default 0
)default charset = utf8;

create table specie (
	id_specie int primary key auto_increment,
    specie_name varchar(100) not null
)default charset = utf8;

insert into specie (id_specie, specie_name) values 
(DEFAULT, 'Cachorro'),
(DEFAULT, 'Gato');

create table size (
	id_size int primary key auto_increment,
    size_name varchar(100) not null
)default charset = utf8;

insert into size (id_size, size_name) values 
(DEFAULT, 'Pequeno'),
(DEFAULT, 'Médio'),
(DEFAULT, 'Grande');

create table breed (
	id_breed int primary key auto_increment,
    id_specie int not null,
    breed_name varchar(100) not null
)default charset = utf8;

create table animalImage (
	id_animal_image int primary key auto_increment,
    id_animal int,
    url varchar(100) not null
)default charset = utf8;

alter table phone
add constraint fk_phone_id_user 
foreign key (id_user) 
references user (id_user);

alter table userToken
add constraint fk_userToken_id_user 
foreign key (id_user) 
references user (id_user);

alter table userAddress 
add constraint fk_userAddress_uf 
foreign key (uf) 
references federativeUnit (uf);

alter table userAddress 
add constraint fk_userAddress_id_user
foreign key (id_user) 
references user (id_user);

alter table animalAddress
add constraint fk_animalAddress_uf 
foreign key (uf) 
references federativeUnit (uf);

alter table animalAddress
add constraint fk_animalAddress_id_animal
foreign key (id_animal) 
references animal (id_animal);

alter table breed
add constraint fk_breed_id_specie
foreign key (id_specie) 
references specie (id_specie);

alter table animal
add constraint fk_animal_id_specie 
foreign key (id_specie)
references specie (id_specie); 

alter table animal
add constraint fk_animal_id_size 
foreign key (id_size)
references size (id_size); 

alter table animal
add constraint fk_animal_id_user
foreign key (id_user)
references user (id_user); 

alter table animal
add constraint fk_animal_id_breed 
foreign key (id_breed)
references breed (id_breed); 

alter table animalImage
add constraint fk_animalImage_id_animal
foreign key (id_animal)
references animal (id_animal);






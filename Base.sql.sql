create table articles
(
	idt smallint auto_increment
		primary key,
	nom varchar(20) null,
	prix smallint null,
	idt_restaurant smallint not null
);

create table commandes
(
	idt smallint auto_increment
		primary key,
	idt_utilisateur smallint null,
	idt_rest smallint null,
	type varchar(30) null,
	proximite varchar(20) null,
	montant int null,
	statut varchar(30) null,
	created_at datetime null,
	updated_at datetime null
);

create table contients
(
	idt_Commande smallint not null,
	idt_article smallint not null,
	primary key (idt_article, idt_Commande)
);

create table restaurants
(
	idt smallint auto_increment
		primary key,
	nom varchar(30) null,
	adresse varchar(50) null,
	specialite varchar(50) null,
	gamme varchar(50) null,
	created_at datetime null,
	updated_at datetime null,
	idt_proprietaire smallint null
);

create table utilisateur
(
	idt smallint auto_increment
		primary key,
	nom varchar(30) null,
	prenom varchar(30) null,
	email varchar(80) null,
	mdp varchar(60) null,
	adresse varchar(40) null,
	statut varchar(30) null,
	created_at datetime null,
	updated_at datetime null
);






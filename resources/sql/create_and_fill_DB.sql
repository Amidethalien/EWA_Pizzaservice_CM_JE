drop table Bestellte_Pizza;
drop table Pizza;
drop table Bestellung;

create table Pizza(
	PizzaID 		int primary key,
	Pizzaname		varchar(255),
	Preis			float,
	Pizzabild		varchar(255)
);

create table Bestellung(
	BestellID		int primary key,
	Adresse			varchar(255),
	Bestellzeitpunkt	date
);

create table Bestellte_Pizza(
	BP_ID			int primary key,
	fPizzaID		int,
	fBestellID		int,
	BP_Status		varchar(255),
	constraint foreign key (fPizzaID) references  Pizza(PizzaID) on delete cascade on update restrict,
	constraint foreign key (fBestellID) references  Bestellung(BestellID) on delete cascade on update restrict
)engine = innodb;

INSERT INTO Pizza
VALUES 	(1,'Krasse Pizza',5.50,NULL),
	(2,'Tee Pizza',6.50,NULL),
        (3,'Coole Pizza',8.50,NULL);

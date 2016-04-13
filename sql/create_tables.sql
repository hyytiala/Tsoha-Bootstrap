CREATE TABLE Asiakas(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	osoite varchar(100) NOT NULL,
	postinumero varchar(10) NOT NULL,
	postipaikka varchar(50) NOT NULL,
	puhelin varchar(50),
	email varchar(50)
);

CREATE TABLE Tyomies(
	id SERIAL PRIMARY KEY,
	nimi varchar(50) NOT NULL,
	salasana varchar(50) NOT NULL,
	puhelin varchar(50) NOT NULL,
	tunnit DECIMAL DEFAULT 0
);

CREATE TABLE Kohde(
	id SERIAL PRIMARY KEY,
	osoite varchar(100) NOT NULL,
	aloitettu DATE NOT NULL,
	tila varchar(10) NOT NULL,
	kuvaus varchar(200),
	katselu boolean DEFAULT FALSE,
	asiakas_id INTEGER REFERENCES Asiakas(id)
);

CREATE TABLE Merkinta(
	id SERIAL PRIMARY KEY,
	paivays TIMESTAMP DEFAULT CURRENT_TIMESTAMP(0),
	tunnit DECIMAL NOT NULL,
	kuvaus varchar(100),
	Kohde INTEGER REFERENCES Kohde(id),
	tyomies INTEGER REFERENCES Tyomies(id)
);

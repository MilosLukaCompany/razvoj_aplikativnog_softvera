CREATE TABLE opstina (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    naziv VARCHAR(50) NULL
);

CREATE TABLE tip_nekretnine (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    tip VARCHAR(50) NULL
);

CREATE TABLE nekretnina (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    adresa VARCHAR(150) NOT NULL,
    kvadratura INT NOT NULL,
    struktura ENUM('Jednosoban', 'Dvosoban', 'Trosoban', 'Cetvorosoban', 'Petosoban') NULL,
    grejanje VARCHAR(150) NULL,
    namestenost ENUM('Namesten', 'Polunamesten', 'Nenamesten') NULL,
    sprat INT NULL,
    spratnost INT NULL,
    cena DECIMAL(20,2) NOT NULL,
    fk_opstina INT NULL,
    fk_tip_nekretnine INT NULL,
    CONSTRAINT fk_nekretnina_opstina FOREIGN KEY (fk_opstina) REFERENCES opstina (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_nekretnina_tip_nekretnine FOREIGN KEY (fk_tip_nekretnine) REFERENCES tip_nekretnine (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE agent (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    jmbg INT NOT NULL,
    adresa VARCHAR(150) NULL,
    telefon VARCHAR(15),
    korisnicko_ime VARCHAR(20) NOT NULL,
    sifra VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE kupac (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ime VARCHAR(50) NOT NULL,
    prezime VARCHAR(50) NOT NULL,
    jmbg INT NOT NULL,
    adresa VARCHAR(150) NULL,
    telefon VARCHAR(15),
    korisnicko_ime VARCHAR(20) NOT NULL,
    sifra VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL
);

CREATE TABLE gledanje_nekretnine (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    vreme DATETIME NOT NULL,
    fk_agent INT NOT NULL,
    fk_kupac INT NOT NULL,
    fk_nekretnina INT NOT NULL,
    CONSTRAINT fk_gledanje_nekretnine_agent FOREIGN KEY (fk_agent) REFERENCES agent (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_gledanje_nekretnine_kupac FOREIGN KEY (fk_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_geldanje_nekretnine_nekretnina FOREIGN KEY (fk_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE ugovor (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    datum DATE NOT NULL,
    fk_agent INT NOT NULL,
    fk_kupac INT NOT NULL,
    fk_nekretnina INT NOT NULL,
    CONSTRAINT fk_ugovor_agent FOREIGN KEY (fk_agent) REFERENCES agent (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_ugovor_kupac FOREIGN KEY (fk_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_ugovor_nekretnina FOREIGN KEY (fk_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);

CREATE TABLE lista_zelja (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    fk_kupac INT NOT NULL,
    fk_nekretnina INT NOT NULL,
    CONSTRAINT fk_lista_zelja_kupac FOREIGN KEY (fk_kupac) REFERENCES kupac (id) ON DELETE NO ACTION ON UPDATE NO ACTION,
    CONSTRAINT fk_lista_zelja_nekretnina FOREIGN KEY (fk_nekretnina) REFERENCES nekretnina (id) ON DELETE NO ACTION ON UPDATE NO ACTION
);
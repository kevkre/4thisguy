<?php

//CREATE database IF NOT EXISTS FLY_Cinema; USE FLY_Cinema;

$statement = 
"CREATE database FLY_Cinema; USE FLY_Cinema;
CREATE TABLE film
  (
     film_id           INTEGER NOT NULL auto_increment PRIMARY KEY,
     titel             VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci UNIQUE NOT NULL,
     filmlaenge        VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     fsk               VARCHAR(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     erscheinungsdatum DATE NOT NULL,
     beschreibung      VARCHAR(1024) NOT NULL,
     bild              VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     banner            VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci,
     trailer           VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL 
  );

CREATE TABLE genre
  (
     genre_id    INTEGER NOT NULL auto_increment PRIMARY KEY,
     bezeichnung VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci UNIQUE NOT NULL
  );

CREATE TABLE film_genre
  (
     filmgenre_id INTEGER NOT NULL auto_increment PRIMARY KEY,
     genreid      INTEGER NOT NULL,
     filmid       INTEGER NOT NULL,
     FOREIGN KEY (genreid) REFERENCES genre(genre_id),
     FOREIGN KEY (filmid) REFERENCES film(film_id)
  );

CREATE TABLE standort
  (
     standort_id INTEGER NOT NULL auto_increment PRIMARY KEY,
     osm_id      INTEGER NOT NULL,
     stadt       VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     plz         VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     bundesland  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  );

CREATE TABLE kino
  (
     kino_id     INTEGER NOT NULL auto_increment PRIMARY KEY,
     hausnummer  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     strasse     VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     standortid  INTEGER NOT NULL,
     bezeichnung VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  );

CREATE TABLE sitzplatz
  (
     sitzplatz_id       INTEGER NOT NULL auto_increment,
     kinosaalid         INTEGER NOT NULL,
     paerchensitz       BOOLEAN NOT NULL,
     sitzplatz_nummer   INTEGER NOT NULL,
     behindertengerecht BOOLEAN NOT NULL,
     reihe              VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
          PRIMARY KEY(sitzplatz_id, kinosaalid),
     premiumsitz        BOOLEAN NOT NULL
  );

CREATE TABLE kinosaal
  (
     kinosaal_id INTEGER NOT NULL auto_increment,
     kinoid      INTEGER NOT NULL,
          PRIMARY KEY(kinosaal_id, kinoid),
     bezeichnung VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     laenge      VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     breite      VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  );

CREATE TABLE vorstellung
  (
     vorstellung_id     INTEGER NOT NULL auto_increment PRIMARY KEY,
     vorstellungslaenge INTEGER NOT NULL,
     datum              DATE NOT NULL,
     is3d               BOOLEAN NOT NULL,
     uhrzeit            TIME NOT NULL,
     beschreibung       VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     grundpreis         DECIMAL(5, 2) NOT NULL,
     filmid             INTEGER NOT NULL,
     kinosaalid         INTEGER NOT NULL,
     FOREIGN KEY (kinosaalid) REFERENCES kinosaal(kinosaal_id),
     FOREIGN KEY (filmid) REFERENCES film(film_id)
  );

CREATE TABLE vorstellungssitzplatz
  (
     vorstellungssitzplatz_id INTEGER NOT NULL auto_increment PRIMARY KEY,
     sitzplatzid              INTEGER NOT NULL,
     vorstellungid            INTEGER NOT NULL,
     belegt                   BIT(1) NOT NULL DEFAULT 0,
     FOREIGN KEY (sitzplatzid) REFERENCES sitzplatz(sitzplatz_id),
     FOREIGN KEY (vorstellungid) REFERENCES vorstellung(vorstellung_id) ON DELETE CASCADE
  );

CREATE TABLE aufschlag
  (
     aufschlag_id INTEGER NOT NULL auto_increment PRIMARY KEY,
     preis        DECIMAL(5, 2) NOT NULL,
     bezeichnung  VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL
  );

CREATE TABLE account
  (
     user_id          INTEGER NOT NULL auto_increment PRIMARY KEY,
     strasse          VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     hausnummer       VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     e_mail           VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     geburtsdatum     DATE NOT NULL,
     vorname          VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     nachname         VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     standortid       INTEGER NOT NULL,
     passwort         VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     active           BIT(1) NOT NULL DEFAULT 0,
     registration_key VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     FOREIGN KEY (standortid) REFERENCES standort(standort_id)
  );

CREATE TABLE rechnung
  (
     rechnung_id       INTEGER NOT NULL auto_increment PRIMARY KEY,
     pdf_id            VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     ausstellungsdatum DATE NOT NULL,
     bezahlmethode     VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     storno            BOOLEAN NOT NULL,
     vorstellungid     INTEGER NOT NULL,
     userid            INTEGER NOT NULL,
     FOREIGN KEY (vorstellungid) REFERENCES vorstellung(vorstellung_id) ON DELETE CASCADE,
     FOREIGN KEY(userid) REFERENCES account(user_id)
  );

CREATE TABLE rechnungsaufschlag
  (
     rechnungsaufschlag_id INTEGER NOT NULL auto_increment PRIMARY KEY,
     rechnungid            INTEGER NOT NULL,
     aufschlagid           INTEGER NOT NULL,
     FOREIGN KEY (rechnungid) REFERENCES rechnung(rechnung_id) ON DELETE CASCADE,
     FOREIGN KEY (aufschlagid) REFERENCES aufschlag(aufschlag_id)
  );

CREATE TABLE zusatzangebot
  (
     zusatzangebot_id INTEGER auto_increment NOT NULL PRIMARY KEY,
     titel            VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     beschreibung     VARCHAR(1023) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
     preis            DECIMAL(5, 2) NOT NULL,
     uuid             VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci
  );

CREATE TABLE rechnung_zusatzangebote
  (
     rechnungzstid   INTEGER auto_increment NOT NULL PRIMARY KEY,
     rechnungid      INTEGER NOT NULL,
     zusatzangebotid INTEGER NOT NULL,
     FOREIGN KEY (rechnungid) REFERENCES rechnung(rechnung_id) ON DELETE CASCADE,
     FOREIGN KEY (zusatzangebotid) REFERENCES zusatzangebot(zusatzangebot_id)
  );

CREATE INDEX idx_titel ON film (titel);

CREATE INDEX idx_stadt ON standort (stadt);

CREATE INDEX idx_bezeichnung ON kinosaal (bezeichnung);

CREATE INDEX idx_nachname ON account(nachname);

CREATE INDEX idx_vorstellung ON vorstellung(vorstellung_id);

CREATE INDEX idx_datum ON vorstellung(datum);

CREATE INDEX idx_sitzplatz_vorstellung ON vorstellungssitzplatz(sitzplatzid);



CREATE INDEX idx_vorstellung_id ON vorstellungssitzplatz(vorstellungid);

CREATE INDEX idx_sitzplatz ON sitzplatz (sitzplatz_id); 
";
$statement ->exec($Database);
?>


 

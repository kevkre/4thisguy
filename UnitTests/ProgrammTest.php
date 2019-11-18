<?php


use PHPUnit\Framework\TestCase;

class ProgrammTest extends TestCase
{

    private $connection;
    private $programm;

    public function setUp():void
    {

        //include_once("./components/Klassen/Programm.php");

        unset($this->programm);

        $this->programm = new Programm("Connection");

    }

    /**test */
    public function test_get_is_logged_in()
    {

        $this->assertEquals(null, $this->programm->getIsloggedin());

    }

    /**test */
    public function test_set_is_logged_in()
    {

        $this->programm->setIsloggedin(true);

        $this->assertEquals(true, $this->programm->getIsloggedin());

    }

    /**test */
    public function test_get_connection()
    {

        $this->assertEquals("Connection", $this->programm->getConnection());

    }

    /**test */
    public function test_set_connection()
    {

        $this->programm->setConnection("new");

        $this->assertEquals("new", $this->programm->getConnection());

    }

    /**test */
    public function test_get_Suchkriterien()
    {

        $this->assertEquals(array(), $this->programm->getSuchkriterien());

    }

    /**test */
    public function test_set_Suchkriterien()
    {

        $this->programm->setSuchkriterien("Suchkriterien");

        $this->assertEquals("Suchkriterien", $this->programm->getSuchkriterien());

    }

    /**test */
    public function test_get_Suchparameter()
    {

        $this->assertEquals(array("titel" => "", "genre.bezeichnung" => "", "stadt" => "", "datum" => ""), $this->programm->getSuchparameter());

    }

    /**test */
    public function test_set_Suchparameter()
    {

        $this->programm->setSuchparameter("Suchparameter");

        $this->assertEquals("Suchparameter", $this->programm->getSuchparameter());

    }

    /**@test */
    public function test_get_gesuchte_Vorstellungen()
    {

        $this->assertEquals(array(), $this->programm->getGesuchteVorstellungen());

    }

    /**test */
    public function test_set_gesuchte_Vorstellungen()
    {

        $this->programm->setGesuchteVorstellungen(array("Vorstellung"));

        $this->assertEquals(array("Vorstellung"), $this->programm->getGesuchteVorstellungen());

    }

    /**@test */
    public function test_get_Filmdaten()
    {

        $this->assertEquals(array(), $this->programm->getFilmDaten());

    }

    /**@test */
    public function test_wurde_durchsucht()
    {

        $this->assertEquals(null, $this->programm->getWurdeDurchsucht());

    }

    /**@test */
    public function test_get_Datum()
    {

        $this->assertEquals(date("Y-m-d"), $this->programm->getDatum());

    }

    /**@test */
    public function test_get_Uhrzeit()
    {

        $this->assertEquals(null, $this->programm->getUhrzeit());

    }

    /**test */
    public function test_set_Datum()
    {

        $this->programm->setDatum("Datum");

        $this->assertEquals("Datum", $this->programm->getDatum());

    }

    /**test */
    public function test_set_Uhrzeit()
    {

        $this->programm->setUhrzeit("Uhrzeit");

        $this->assertEquals("Uhrzeit", $this->programm->getUhrzeit());

    }

    /**@test */
    public function test_get_Daten_Gesuchte_Vorstellungen()
    {

        $this->assertEquals(array(), $this->programm->getDatenGesuchteVorstellungen());

    }

    /**@test */
    public function test_get_Suchergebnisse()
    {

        $this->assertEquals(array(), $this->programm->getSuchergebnisse());

    }

    /**test */
    public function test_set_Suchergebnisse()
    {

        $this->programm->setSuchergebnisse(array("Suchergebnis"));

        $this->assertEquals(array("Suchergebnis"), $this->programm->getSuchergebnisse());

    }

    /**@test */
    public function test_get_Filme()
    {

        $this->assertEquals(array(), $this->programm->getFilme());

    }

    /**@test */
    public function test_get_Vorstellungen()
    {

        $this->assertEquals(array(), $this->programm->getVorstellungen());

    }

    /**test */
    public function test_set_Vorstellungen()
    {

        $this->programm->setVorstellungen(array("Vorstellung"));

        $this->assertEquals(array("Vorstellung"), $this->programm->getVorstellungen());

    }

    /**@test */
    public function test_set_Vorstellungssitzplätze_Logik()
    {

        $sitzplätze[0] = array("vorstellungssitzplatz_id" => 1, "belegt" => "belegt", "reihe" => "reihe", "premiumsitz" => "premium");

        $vorstellungssitzlätze = array(new Vorstellungssitzplatz(1, "belegt", "reihe", "premium"));

        $this->assertEquals($vorstellungssitzlätze, $this->programm->setVorstellungsSitzplätzeLogik($sitzplätze));

    }

    /**@test */
    public function test_berechne_Index_des_Suchergebnisses_zu_welchem_die_aktuelle_Vorstellung_gehoert()
    {

        $index = 0;

        $this->assertEquals(null, $this->programm->berechneIndexDesSuchergebnissesZuWelchemDieAktuelleVorstellungGehoert($index));

    }

    /**@test */
    public function test_berechne_Index_des_Suchergebnisses_zu_welchem_die_aktuelle_Vorstellung_gehoert_with_mock_data()
    {

        $index = 1;

        $suchergebnis[0] = new Suchergebnis(array("Vorstellung", "Vorstellung"), new Film(1, "Titel", "Länge", "FSK", "Erscheinungsdatum", "Beschreibung", "Bild", "Banner", "Trailer", array("Genre1", "Genre2")));
        $suchergebnis[1] = new Suchergebnis(array("Vorstellung", "Vorstellung"), new Film(2, "Titel", "Länge", "FSK", "Erscheinungsdatum", "Beschreibung", "Bild", "Banner", "Trailer", array("Genre1", "Genre2")));

        $this->programm->setSuchergebnisse($suchergebnis);

        $vorstellung[0] = new Vorstellung("ID", "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");
        $vorstellung[1] = new Vorstellung("ID", "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");

        $this->programm->setGesuchteVorstellungen($vorstellung);

        $this->assertEquals(1, $this->programm->berechneIndexDesSuchergebnissesZuWelchemDieAktuelleVorstellungGehoert($index));

    }

    /**@test */
    public function test_gib_Vorstellung_by_Id()
    {

        $id = 2;

        $this->assertEquals(null, $this->programm->gibVorstellungById($id));

    }

    /**@test */
    public function test_gib_Vorstellung_by_Id_with_mock_data()
    {

        $vorstellung = array();

        $id = 2;

        $vorstellung[0] = new Vorstellung(1, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");
        $vorstellung[1] = new Vorstellung(2, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");

        $this->programm->setVorstellungen($vorstellung);

        $this->assertEquals(new Vorstellung(2, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz"), $this->programm->gibVorstellungById($id));

    }

    ///**@test */ TODO: DB Zugriff
    /*public function test_gib_alle_Vorstellungen_Logik()
    {

        $vorstellungDB = array();

        $vorstellungDB[0] = array("vorstellung_id" => 1, "vorstellungslaenge" => "länge", "datum" => "datum", "is3d" => "is3d", "uhrzeit" => "uhrzeit", "beschreibung" => "beschreibung", "grundpreis" => "grundpreis", "filmid" => "filmid", "kinosaalid" => "kinosaalid");

        $vorstellung = array();

        $vorstellung[0] = new Vorstellung(1, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");
        $vorstellung[1] = new Vorstellung(2, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz");

        $this->programm->setVorstellungen($vorstellung);

        $this->assertEquals(new Vorstellung(2, "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", 2, "Kinosaal", "Vorstellungssitzplatz"), $this->programm->gibVorstellungById($id));

    }*/

    /**@test */
    public function test_gib_alle_Filmdaten_Konstruktor()
    {

        //$film[0] = new Film(0, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));

        $filmDB[0] = array("film_id" => 0, "titel" => "titel", "filmlaenge" => "filmlaenge", "fsk" => "fsk","erscheinungsdatum" => "erscheinungsdatum", "beschreibung" => "beschreibung", "bild" => "bild", "banner" => "banner", "trailer" => "trailer");

        $this->programm->gibAlleFilmDatenKonstruktor($filmDB, array("Genre1", "Genre2"), 0);

        $this->assertEquals(array(new Film(0, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"))), $this->programm->getFilme());

    }

    /**@test */
    public function test_gib_alle_Kinodaten_Logik()
    {

        $kinoDB[0] = array("kino_id" => 0, "hausnummer" => "hausnummer", "strasse" => "strasse", "bezeichnung" => "bezeichnung","stadt" => "stadt", "plz" => "plz");

        $this->programm->gibAlleKinoDatenLogik($kinoDB);

        $this->assertEquals(array("bezeichnung" => new Kino(0, "hausnummer", "strasse", "bezeichnung", "stadt", "plz")), $this->programm->getKinos());

    }

    /**@test */
    public function test_berechne_Gesamtpreis()
    {

        $this->assertEquals(12, $this->programm->berechneGesamtpreis(3, 4));

    }

    /**@test */
    public function test_gib_alle_Angebotsdaten_Logik_with_mock_data()
    {

        $id[0] = array("zusatzangebot_id" => 0, "uuid" => "uuid", "preis" => "preis","titel" => "titel", "beschreibung" => "beschreibung");
        $id[1] = array("zusatzangebot_id" => 1, "uuid" => "uuid", "preis" => "preis","titel" => "titel", "beschreibung" => "beschreibung");

        $this->programm->gibAlleAngebotsDatenLogik($id);

        $this->assertEquals(array(new Zusatzangebot(0, "uuid", "preis", "titel", "beschreibung"), new Zusatzangebot(1, "uuid", "preis", "titel", "beschreibung")), $this->programm->getZusatzangebote());

    }

    /**@test */
    public function test_gib_alle_Angebotsdaten_Logik()
    {

        $id = array(1, 2);

        $this->assertEquals(null, $this->programm->gibAlleAngebotsDatenLogik($id));

    }

    /**@test */
    public function test_get_Film_mit_FilmId()
    {

        $id = 2;

        $this->assertEquals(null, $this->programm->getFilmMitFilmId($id));

    }

    /**@test */
    public function test_get_Film_mit_FilmId_with_mock_data()
    {

        $film = array();

        $id = 2;

        $film[0] = new Film(1, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));
        $film[1] = new Film(2, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));

        $this->programm->setFilme($film);

        $this->assertEquals(new Film(2, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2")), $this->programm->getFilmMitFilmId($id));

    }

    /**@test */
    public function test_anmelden_Logik_user_existiert_nicht()
    {

        $this->assertEquals(0, $this->programm->anmeldenLogik(null, null));

    }

    /**@test */
    public function test_anmelden_Logik_user_existiert()
    {

        $benutzer[0] = array("passwort" => "c06db68e819be6ec3d26c6038d8e8d1f", "vorname" => "Vorname", "nachname" => "Nachname", "geburtsdatum" => "Geburtsdatum", "standortid" => "id", "strasse" => "Strasse", "hausnummer" => "Hausnummer", "e_mail" => "EMail", "registration_key" => 0, "active" => 1, "user_id" => 1);

        $actual = $this->programm->anmeldenLogik($benutzer, "test12345");

        $expected = array("c06db68e819be6ec3d26c6038d8e8d1f", "c06db68e819be6ec3d26c6038d8e8d1f", "Nachname", "Geburtsdatum", "12345", "Stadt", "Strasse", "Hausnummer", "EMail", 0, TRUE, 1);

        $this->assertEquals($expected, $actual);

    }

    /**@test */
    public function test_gib_alle_Kinosaaldaten_Logik_mit_VorstellungsId_with_mock_data()
    {

        $id[0] = array("kinosaal_id" => 0, "bezeichnung" => "bezeichnung", "laenge" => "laenge","breite" => "breite");
        $id[1] = array("kinosaal_id" => 1, "bezeichnung" => "bezeichnung", "laenge" => "laenge","breite" => "breite");

        $this->programm->gibAlleKinosaalDatenLogikMitVorstellungsId($id);

        $this->assertEquals(array(new Kinosaal(0, "bezeichnung", "laenge", "breite"), new Kinosaal(1, "bezeichnung", "laenge", "breite")), $this->programm->getkinosaale());

    }

    /**@test */
    public function test_gib_alle_Kinosaaldaten_Logik_mit_VorstellungsId()
    {

        $id = array(1, 2);

        $this->assertEquals(null, $this->programm->gibAlleKinosaalDatenLogikMitVorstellungsId($id));

    }

    /**@test */
    public function test_get_Vorstellungssitzplaetze_Logik_with_mock_data()
    {

        $dbausgabe[0] = array("vorstellungssitzplatz_id" => 1, "belegt" => "belegt", "reihe" => "reihe", "premiumsitz" => "premiumsitz");
        $dbausgabe[1] = array("vorstellungssitzplatz_id" => 2, "belegt" => "belegt", "reihe" => "reihe", "premiumsitz" => "premiumsitz");

        $this->assertEquals(array(new Vorstellungssitzplatz(1, "belegt", "reihe", "premiumsitz"), new Vorstellungssitzplatz(2, "belegt", "reihe", "premiumsitz")), $this->programm->getVorstellungsSitzplaetzeLogik($dbausgabe));

    }

    /**@test */
    public function test_get_Banner_nach_Haeufigkeit_Logik_with_mock_data()
    {

        $dbausgabe[0] = array("film_id" => 1, "titel" => "titel", "filmlaenge" => "filmlaenge", "fsk" => "fsk","erscheinungsdatum" => "erscheinungsdatum", "beschreibung" => "beschreibung", "bild" => "bild", "banner" => "banner", "trailer" => "trailer");
        $dbausgabe[1] = array("film_id" => 2, "titel" => "titel", "filmlaenge" => "filmlaenge", "fsk" => "fsk","erscheinungsdatum" => "erscheinungsdatum", "beschreibung" => "beschreibung", "bild" => "bild", "banner" => "banner", "trailer" => "trailer");
        $dbausgabe[2] = array("film_id" => 3, "titel" => "titel", "filmlaenge" => "filmlaenge", "fsk" => "fsk","erscheinungsdatum" => "erscheinungsdatum", "beschreibung" => "beschreibung", "bild" => "bild", "banner" => "banner", "trailer" => "trailer");
        $dbausgabe[3] = array("film_id" => 4, "titel" => "titel", "filmlaenge" => "filmlaenge", "fsk" => "fsk","erscheinungsdatum" => "erscheinungsdatum", "beschreibung" => "beschreibung", "bild" => "bild", "banner" => "banner", "trailer" => "trailer");

        $expected = array(new Film(1, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2")), new Film(2, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2")), new Film(3, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2")));

        $film[0] = new Film(1, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));
        $film[1] = new Film(2, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));
        $film[2] = new Film(3, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));
        $film[3] = new Film(4, "titel", "filmlaenge", "fsk", "erscheinungsdatum", "beschreibung", "bild", "banner", "trailer", array("Genre1", "Genre2"));

        $this->programm->setFilme($film);

        $this->assertEquals($expected, $this->programm->getBannerNachHaeufigkeitLogik($dbausgabe, 3));

    }


}
?>
<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Vorstellung.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Suchergebnis.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Film.php"); 
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Kino.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Zusatzangebot.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Vorstellungssitzplatz.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Warenkorb.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Kinosaal.php");

//Zeile auskommentiert. Check later.

//include_once($_SERVER['DOCUMENT_ROOT']. "/components/FilmDetails.php");

//Zeile auskommentiert. Check later.
class Programm
{

    private $filme = array();
    private $kinos = array();
    private $vorstellungen = array();
    private $zusatzangebote = array();
    private $datum;
    private $uhrzeit;
    private $zeitzone;
    private $suchkriterien = array();
    private $suchparameter = array();
    private $gesuchteVorstellungen = array();
    private $connection;
    private $datenGesuchteVorstellungen = array();
    private $suchergebnisse = array();
    private $filmDaten = array();
    private $isloggedin;
    private $wurdeDurchsucht;
    private $warenkorb;
    private $kinosaale = array();

    public function __construct($connection)
    {
        $this->connection = $connection;
        $this->wurdeDurchsucht = false;
        $this->zeitzone = date_default_timezone_get();
        $this->datum = date("Y-m-d");
        $this->suchparameter = array("titel" => "", "genre.bezeichnung" => "", "stadt" => "", "datum" => "");  /* Anzahl, Reihenfolge und Kombination der Key-Value-Paare ist egal, wichtig ist nur, dass der Key genauso heißt, wie hier */

    }

    /**
     * @return mixed
     */
    public function getIsloggedin()
    {
        return $this->isloggedin;
    }

    /**
     * @param mixed $isloggedin
     */
    public function setIsloggedin($isloggedin)
    {
        $this->isloggedin = $isloggedin;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
    }

    /**
     * @return mixed
     */
    public function getGesuchteVorstellungen()
    {
        return $this->gesuchteVorstellungen;
    }

    /**
     * @param mixed $gesuchteVorstellungen
     */
    public function setGesuchteVorstellungen($gesuchteVorstellungen)
    {
        $this->gesuchteVorstellungen = $gesuchteVorstellungen;
    }

    /**
     * @return mixed
     */
    public function getFilmDaten()
    {
        return $this->filmDaten;
    }

    /**
     * @param $suchkriterien
     */
    public function setSuchkriterien($suchkriterien)
    {
        $this->suchkriterien = $suchkriterien;
    }

    /**
     * @param $suchparameter
     */
    public function setSuchparameter($suchparameter)
    {
        $this->suchparameter = $suchparameter;
    }

    /**
     * @return mixed
     */
    public function getWurdeDurchsucht()
    {
        return $this->wurdeDurchsucht;
    }

    /**
     * @return mixed
     */
    public function getSuchkriterien()
    {
        return $this->suchkriterien;
    }

    /**
     * @return mixed
     */
    public function getSuchparameter()
    {
        return $this->suchparameter;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @return mixed
     */
    public function getUhrzeit()
    {
        return $this->uhrzeit;
    }

    /**
     * @param $datum
     */
    public function setDatum($datum)
    {
        $this->datum = $datum;
    }

    /**
     * @param $uhrzeit
     */
    public function setUhrzeit($uhrzeit)
    {
        $this->uhrzeit = $uhrzeit;
    }

    /**
     * @return mixed
     */
    public function getDatenGesuchteVorstellungen()
    {
        return $this->datenGesuchteVorstellungen;
    }

    /**
     * @return mixed
     */
    public function getSuchergebnisse()
    {
        return $this->suchergebnisse;
    }

    /**
     * @param $suchergebnisse
     */
    public function setSuchergebnisse($suchergebnisse)
    {
        $this->suchergebnisse = $suchergebnisse;
    }

    /**
     * @return mixed
     */
    public function getFilme()
    {
        return $this->filme;
    }

    /**
     * @param $filme
     */
    public function setFilme($filme)
    {
        $this->filme = $filme;
    }

    /**
     * @return mixed
     */
    public function getVorstellungen()
    {
        return $this->vorstellungen;
    }

    /**
     * @return mixed
     */
    public function getKinos()
    {
        return $this->kinos;
    }

    /**
     * @return mixed
     */
    public function getZusatzangebote()
    {
        return $this->zusatzangebote;
    }

    /**
     * @return mixed
     */
    public function getKinosaale()
    {
        return $this->kinosaale;
    }

    /**
     * @param $vorstellungen
     */
    public function setVorstellungen($vorstellungen)
    {
        $this->vorstellungen = $vorstellungen;
    }

    public function setSitzplatzBelegt($Sitzplazid){

        global $connection;
        $statement = $connection->prepare("Update vorstellungssitzplatz SET belegt = 1 WHERE vorstellungssitzplatz_id ='{$Sitzplazid}';");
        $statement->execute();

    }

    public function setVorstellungsSitzplaetze($vorstellungsId)
    {
        $vorstellungsSitzplaetze = array();
        $statement = $this->connection->prepare("SELECT  vorstellungssitzplatz_id, belegt,reihe,premiumsitz FROM vorstellungssitzplatz INNER JOIN vorstellung ON vorstellung.Vorstellung_id = vorstellungssitzplatz.vorstellungid
                    INNER JOIN sitzplatz ON sitzplatz.sitzplatz_id = vorstellungssitzplatz.sitzplatzid  
                    WHERE vorstellung_id = $vorstellungsId");
        $statement->execute();
        $sitzplaetze = $statement->fetchAll();

        return $result = $this->setVorstellungsSitzplätzeLogik($sitzplaetze);

    }

    public function setVorstellungsSitzplätzeLogik($sitzplaetze){

        $vorstellungsSitzplaetze = array();

        foreach ($sitzplaetze as $v) {
            $vorstellungsSitzplaetze[] = new Vorstellungssitzplatz($v["vorstellungssitzplatz_id"], $v["belegt"], $v["reihe"], $v["premiumsitz"]);
        }

        return $vorstellungsSitzplaetze;

    }

    public function sucheVorstellungen($suchparameter)
    {
        $this->aktualisieren();

        if($suchparameter["datum"]!=""){

            $this->wurdeDurchsucht=true;

        }

        $this->datenGesuchteVorstellungen = array();

        switch ($suchparameter["titel"]) {

            case "Alle Filme":

                if ($suchparameter["genre.bezeichnung"] == "Genres") {

                    $statement = $this->connection->prepare("SELECT DISTINCT vorstellung.vorstellung_id, vorstellungslaenge, datum, is3d,uhrzeit, vorstellung.beschreibung, grundpreis, vorstellung.filmid, kinosaalid  FROM vorstellung INNER JOIN film ON vorstellung.filmid = film.film_id INNER JOIN film_genre ON film.film_id = film_genre.filmid  INNER JOIN genre ON genre.genre_id = film_genre.genreid INNER JOIN kinosaal ON vorstellung.kinosaalid = kinosaal.kinosaal_id INNER JOIN kino ON kinosaal.kinoid = kino.kino_id INNER JOIN standort ON standort.standort_id = kino.standortid WHERE stadt = '{$suchparameter["stadt"]}' AND vorstellung.datum = '{$suchparameter["datum"]}'");
                    $statement->execute();

                    if($statement->rowCount() > 0) {

                        $this->datenGesuchteVorstellungen = $statement->fetchAll(\PDO::FETCH_ASSOC);

                    } else {

                        $this->datenGesuchteVorstellungen = null;

                    };

                } else {

                    $statement = $this->connection->prepare("SELECT DISTINCT vorstellung.vorstellung_id, vorstellungslaenge, datum, is3d, uhrzeit, vorstellung.beschreibung, grundpreis, vorstellung.filmid, kinosaalid  FROM vorstellung INNER JOIN film ON vorstellung.filmid = film.film_id INNER JOIN film_genre ON film.film_id = film_genre.filmid  INNER JOIN genre ON genre.genre_id = film_genre.genreid INNER JOIN kinosaal ON vorstellung.kinosaalid = kinosaal.kinosaal_id INNER JOIN kino ON kinosaal.kinoid = kino.kino_id INNER JOIN standort ON standort.standort_id = kino.standortid WHERE stadt = '{$suchparameter["stadt"]}' AND vorstellung.datum = '{$suchparameter["datum"]}' AND genre.bezeichnung = '{$suchparameter["genre.bezeichnung"]}'");
                    $statement->execute();

                    if($statement->rowCount() > 0) {

                        $this->datenGesuchteVorstellungen = $statement->fetchAll(\PDO::FETCH_ASSOC);

                    } else {

                        $this->datenGesuchteVorstellungen = null;

                    }
                }

                break;

                default :

                $statement = $this->connection->prepare("SELECT DISTINCT vorstellung.vorstellung_id, vorstellungslaenge, datum, is3d,uhrzeit, vorstellung.beschreibung, grundpreis, vorstellung.filmid, kinosaalid  FROM vorstellung INNER JOIN film ON vorstellung.filmid = film.film_id INNER JOIN film_genre ON film.film_id = film_genre.filmid  INNER JOIN genre ON genre.genre_id = film_genre.genreid INNER JOIN kinosaal ON vorstellung.kinosaalid = kinosaal.kinosaal_id INNER JOIN kino ON kinosaal.kinoid = kino.kino_id INNER JOIN standort ON standort.standort_id = kino.standortid WHERE stadt = '{$suchparameter["stadt"]}' AND vorstellung.datum = '{$suchparameter["datum"]}' AND film.titel ='{$suchparameter["titel"]}'");
                $statement->execute();

                if($statement->rowCount() > 0) {

                    $this->datenGesuchteVorstellungen = $statement->fetchAll(\PDO::FETCH_ASSOC);

                } else {

                        $this->datenGesuchteVorstellungen = null;

                }

                break;
                
        }

        if($this->datenGesuchteVorstellungen != null) {

            $zaehlerIndexGesuchteVorstellungen = 0;
            $zaehlerIndexSuchergebnisse = 0;
            
           foreach ($this->datenGesuchteVorstellungen AS $v) {

                //$this->gesuchteVorstellungen[] = new Vorstellung($v["vorstellung_id"],$v["vorstellungslaenge"],$v["datum"],$v["is3d"],$v["uhrzeit"],$v["beschreibung"],$v["grundpreis"],$v["filmid"],$v["kinosaalid"]);
                array_push($this->gesuchteVorstellungen, new Vorstellung($v["vorstellung_id"],$v["vorstellungslaenge"],$v["datum"],$v["is3d"],$v["uhrzeit"],$v["beschreibung"],$v["grundpreis"],$v["filmid"],$v["kinosaalid"], $this->setVorstellungsSitzplaetze($v["vorstellung_id"]) ));
                $indexAktuelleVorstellungInSuchergebnisse =  $this->berechneIndexDesSuchergebnissesZuWelchemDieAktuelleVorstellungGehoert($zaehlerIndexGesuchteVorstellungen);

                if(is_null($indexAktuelleVorstellungInSuchergebnisse)) {

                    //$this->suchergebnisse[] = new Suchergebnis($this->getGesuchteVorstellungen()[$zaehlerIndexGesuchteVorstellungen] , $this->filme[$v["filmid"]]);
                    array_push($this->suchergebnisse,  new Suchergebnis($this->getGesuchteVorstellungen()[$zaehlerIndexGesuchteVorstellungen], $this->filme[$v["filmid"]]));
                    $zaehlerIndexSuchergebnisse = $zaehlerIndexSuchergebnisse + 1;
                }
                else {

                    $this->suchergebnisse[$indexAktuelleVorstellungInSuchergebnisse]->vorstellungHinzufügen($this->getGesuchteVorstellungen()[$zaehlerIndexGesuchteVorstellungen]);

                }
            
                $zaehlerIndexGesuchteVorstellungen = $zaehlerIndexGesuchteVorstellungen + 1;

            }
        }
    }

    public function berechneIndexDesSuchergebnissesZuWelchemDieAktuelleVorstellungGehoert($zaehlerIndexGesuchteVorstellungen) {

        $ausgabe = 0;

        foreach ($this->suchergebnisse AS $s) {

            if($s->getFilm()->getFilmID() == $this->gesuchteVorstellungen[$zaehlerIndexGesuchteVorstellungen]->getFilmID()) {

                return $ausgabe;

            }

            $ausgabe = $ausgabe + 1;
        }

        return NULL;

    }

    public function gibVorstellungById($id){

        foreach($this->vorstellungen as $v) {

            if($v->getVorstellungsID() == $id) {

                return $v;

            }
        }
    }

    public function gibAlleVorstellungen()
    {

        $statement = $this->connection->prepare("SELECT * FROM vorstellung");
        $statement->execute();
        $werte = $statement->fetchAll();

        $this->gibAlleVorstellungenLogik($werte);

    }

    private function gibAlleVorstellungenLogik($werte){

        $vorstellungen = array();

        foreach($werte as $v)
        {
            $vorstellungen[] = new Vorstellung($v["vorstellung_id"],$v["vorstellungslaenge"],$v["datum"],$v["is3d"],$v["uhrzeit"],$v["beschreibung"],$v["grundpreis"],$v["filmid"],$v["kinosaalid"],$this->setVorstellungsSitzplaetze($v["vorstellung_id"]));
        }

        $this->vorstellungen = $vorstellungen;

    }

    public function aktualisieren(){

        $this->gibAlleFilmDaten();

        $this->gibAlleKinoDaten();

    }

    public function gibAlleFilmDaten(){
        
        $statement = $this->connection->prepare("SELECT * FROM film");
        $statement->execute();
        $filmDaten = $statement->fetchAll();

        $statement = $this->connection->prepare("SELECT genre.bezeichnung FROM genre JOIN film_genre ON genre.genre_id = film_genre.genreid JOIN film ON film.film_id = film_genre.filmid WHERE film.film_id = :filmid;" );
        $statement->bindParam(':filmid', $filmId);
        $statement->execute();
        $genre = $statement->fetchAll();

        $this->gibAlleFilmDatenLogik($filmDaten);

        unset($filmDaten);

        return $this->filme;
        
    }

    private function gibAlleFilmDatenLogik($filmDaten){

        for ($i = 0; $i < count($filmDaten, COUNT_NORMAL); $i++) {

            $statement = $this->connection->prepare("SELECT genre.bezeichnung FROM genre JOIN film_genre ON genre.genre_id = film_genre.genreid JOIN film ON film.film_id = film_genre.filmid WHERE film.film_id = :filmid;" );
            $statement->bindParam(':filmid', $filmDaten[$i]['film_id']);
            $statement->execute();
            $genre = $statement->fetchAll();

            $this->gibAlleFilmDatenKonstruktor($filmDaten, $genre, $i);

            unset($genre);

        }
    }

    public function gibAlleFilmDatenKonstruktor($filmDaten, $genre, $i){

        $filmID = $filmDaten[$i]['film_id'];
        $film = new Film($filmDaten[$i]["film_id"], $filmDaten[$i]["titel"], $filmDaten[$i]["filmlaenge"], $filmDaten[$i]["fsk"], $filmDaten[$i]["erscheinungsdatum"], $filmDaten[$i]["beschreibung"], $filmDaten[$i]["bild"], $filmDaten[$i]["banner"], $filmDaten[$i]["trailer"], $genre);
        $this->filme[$filmID] = $film;

    }

    public function gibAlleKinoDaten(){
        $statement = $this->connection->prepare("SELECT * FROM kino JOIN standort ON kino.standortid = standort.standort_id");
        $statement->execute();
        $kinoDaten = $statement->fetchAll();

        $this->gibAlleKinoDatenLogik($kinoDaten);

        unset($kinoDaten);

        return $this->kinos;
    }

    public function gibAlleKinoDatenLogik($kinoDaten){

        for ($i = 0; $i < count($kinoDaten, COUNT_NORMAL); $i++) {

            $bezeichnung = $kinoDaten[$i]['bezeichnung'];
            $kino = new Kino($kinoDaten[$i]["kino_id"], $kinoDaten[$i]["hausnummer"], $kinoDaten[$i]["strasse"], $kinoDaten[$i]["bezeichnung"], $kinoDaten[$i]["stadt"], $kinoDaten[$i]["plz"]);
            $this->kinos[$bezeichnung] = $kino;

        }
    }

    public function getVorstellungsSitzplaetze($vorstellungsID){

        global $connection;
        $statement = $connection->prepare("SELECT  vorstellungssitzplatz_id, belegt,reihe,premiumsitz FROM vorstellungssitzplatz INNER JOIN Vorstellung ON vorstellung.Vorstellung_id = vorstellungssitzplatz.vorstellungid
                    INNER JOIN sitzplatz ON sitzplatz.sitzplatz_id = vorstellungssitzplatz.sitzplatzid  
                    WHERE vorstellung_id = $vorstellungsID");
        $statement->execute();
        $sitzplaetze = $statement->fetchAll();
        
        return $this->getVorstellungsSitzplaetzeLogik($sitzplaetze);

    }

    public function getVorstellungsSitzplaetzeLogik($sitzplaetze){

        $vorstellungsSitzplaetze = array();

        foreach ($sitzplaetze as $v) {
            $vorstellungsSitzplaetze[] = new Vorstellungssitzplatz($v["vorstellungssitzplatz_id"], $v["belegt"], $v["reihe"], $v["premiumsitz"]);
        }

        return $vorstellungsSitzplaetze;

    }

    public function getVorstellungMitId($id){

        $statement = $this->connection->prepare("SELECT * FROM Vorstellung WHERE vorstellung_id = .$id. ");
        $statement->execute();
        $vorstellungDaten = $statement->fetchAll();
        return $vorstellungDaten;

    }
   
    public function getBannerNachHaeufigkeit($anzahl){

        $statement = $this->connection->prepare("SELECT film_id FROM film WHERE banner IS NOT NULL ORDER BY erscheinungsdatum DESC LIMIT $anzahl;");
        $statement->execute();
        $ergebnis = $statement->fetchAll();

        return $this->getBannerNachHaeufigkeitLogik($ergebnis, $anzahl);

    }

    public function getBannerNachHaeufigkeitLogik($ergebnis, $anzahl){

        $filmArray = array();

        for ($i = 0; $i < $anzahl; $i++){

            $filmArray[$i] = $this->getFilmMitFilmId($ergebnis[$i]["film_id"]);

        }

        return $filmArray;

    }

    public function berechneGesamtpreis($grundpreis, $anzahlSitze){

        $basispreis = "{$grundpreis}";
        $anzahlSeats = "{$anzahlSitze}";
        $gesamtpreis = bcmul($basispreis, $anzahlSeats);
        return $gesamtpreis;

    }

    public function gibReihe($SitzplatzId){

        $statement = $this->connection->prepare("SELECT sitzplatz.reihe FROM vorstellungssitzplatz,sitzplatz WHERE vorstellungssitzplatz.vorstellungssitzplatz_id = '{$SitzplatzId}' AND vorstellungssitzplatz.sitzplatzid = sitzplatz.sitzplatz_id;");
        $statement->execute();
        $reihe = $statement->fetchAll();
        return $reihe;

    }

    public function gibSitzplatzNr($SitzplatzId){

        $statement = $this->connection->prepare("SELECT sitzplatz.sitzplatz_nummer FROM vorstellungssitzplatz,sitzplatz WHERE vorstellungssitzplatz.vorstellungssitzplatz_id = '{$SitzplatzId}' AND vorstellungssitzplatz.sitzplatzid = sitzplatz.sitzplatz_id;");
        $statement->execute();
        $nummer = $statement->fetchAll();
        return $nummer;

    }

    public function getFilmMitFilmId($id){

        foreach($this->filme as $v) {

            if($v->getFilmId() == $id){

                return $v;

            }
        }
    }

    public function speichereRechnung($rechnungsId,$storno,$austellungsdatum,$bezahlmethode,$userid,$vorstellungsid){
        $statement = $this->connection->prepare("INSERT INTO rechnung(pdf_id,ausstellungsdatum,bezahlmethode,storno,vorstellungid,userid) VALUES($rechnungsId,'{$austellungsdatum}','{$bezahlmethode}',$storno,$vorstellungsid,$userid);");
        $statement->execute();
    }

    public function gibAlleAngebotsDaten(){

        $statement = $this->connection->prepare("SELECT * FROM zusatzangebot");
        $statement->execute();
        $angebotsDaten = $statement->fetchAll();

        $this->gibAlleAngebotsDatenLogik($angebotsDaten);

        return $this->zusatzangebote;

    }

    public function gibAlleAngebotsDatenLogik($angebotsDaten){

        for($i = 0; $i < count($angebotsDaten, COUNT_NORMAL); $i++){
            $zusatzangeboteID = $angebotsDaten[$i]['zusatzangebot_id'];
            $zusatzangebot = new Zusatzangebot($angebotsDaten[$i]["zusatzangebot_id"],$angebotsDaten[$i]["uuid"],$angebotsDaten[$i]["preis"], $angebotsDaten[$i]["titel"], $angebotsDaten[$i]["beschreibung"]);
            $this->zusatzangebote[$zusatzangeboteID] = $zusatzangebot;
        }

    }

    public function anmelden($email, $password){

        $statement = $this->connection->prepare("SELECT * FROM account WHERE e_mail = '{$email}' LIMIT 1;");
        //$result = $statement->execute(array('e_mail' => $email));
        $statement->execute();
        $user = $statement->fetchAll();
        //Check Password
        $result = $this->anmeldenLogik($user, $password);

        return $result;

    }

    public function anmeldenLogik($user, $password){
        //Check Password
        if (!empty($user) && md5($password) == $user[0]["passwort"] && $user[0]['active'] == 1 ) {

            echo '<script language="javascript">';
            echo 'window.onload = function(){alert("Login erfolgreich")}';
            echo '</script>';
            $this->isloggedin = true;
            $_SESSION["vorname"] = $user[0]['vorname'];
            $_SESSION["nachname"]= $user[0]['nachname'];
            $_SESSION["loggedin"] = true;
            $_SESSION["userId"] = $user[0]['user_id'];
            return  array($user[0]['passwort'], $user[0]['passwort'], $user[0]['nachname'], $user[0]['geburtsdatum'], "12345", "Stadt", $user[0]['strasse'], $user[0]['hausnummer'], $user[0]['e_mail'], $user[0]['registration_key'], TRUE, $user[0]['active']);

        } else {

            $errorMessage = "E-Mail oder Passwort war ungültig";
            echo '<script language="javascript"> window.onload = function(){alert("'.$errorMessage.'")}';
            echo '</script>';

            return 0;
        }

    }

    public function gibKinoSaalDatenMitVorstellungsId($VorstellungsId){
        $statement = $this->connection->prepare("SELECT kinosaal_id, kinoid, bezeichnung, laenge, breite FROM kinosaal INNER JOIN vorstellung ON kinosaal.kinosaal_id = vorstellung.kinosaalid WHERE vorstellung.vorstellung_id = '{$VorstellungsId}';");
        $statement->execute();
        $kinosaalDaten = $statement->fetchAll();
        $this->gibAlleKinosaalDatenLogikMitVorstellungsId($kinosaalDaten);
        return $this->kinosaale;
    }

    public function gibAlleKinosaalDatenLogikMitVorstellungsId($kinosaalDaten){

        for($i = 0; $i < count($kinosaalDaten, COUNT_NORMAL); $i++){
            $kinosaalID = $kinosaalDaten[$i]['kinosaal_id'];
            $$kinosaalID = new Kinosaal($kinosaalDaten[$i]["kinosaal_id"],$kinosaalDaten[$i]["bezeichnung"], $kinosaalDaten[$i]["laenge"], $kinosaalDaten[$i]["breite"]);
            $this->kinosaale[$kinosaalID] = $$kinosaalID;
        }

    }

    function gibAlleFilme()
    {
        global $connection;
        $statement = $connection->prepare("SELECT titel FROM film;");
        $statement->execute();
        $ergebnis = $statement->fetchAll();

        return $ergebnis;
    }
    function gibAlleStandorte()
    {
        global $connection;
        $statement = $connection->prepare("SELECT DISTINCT stadt FROM kino,standort WHERE kino.standortID = standort.standort_ID;");
        $statement->execute();
        $ergebnis = $statement->fetchAll();

        return $ergebnis;
    }
    function gibAlleGenre()
    {
        global $connection;
        $statement = $connection->prepare("SELECT bezeichnung FROM genre ");
        $statement->execute();
        $ergebnis = $statement->fetchAll();
        return $ergebnis;
    }

  /*  public function gibWarenkorbDaten($booked, $vorstellungsID){
        $statement = $this->connection->prepare("SELECT film.titel,vorstellung.datum, vorstellung.uhrzeit, sitzplatz.sitzplatz_nummer,  sitzplatz.reihe,vorstellung.grundpreis, standort.stadt, vorstellung.is3d
        FROM vorstellung INNER JOIN film ON vorstellung.filmid = film.film_id INNER JOIN kinosaal ON vorstellung.kinosaalid = kinosaal.kinosaal_id INNER JOIN kino ON kinosaal.kinoid = kino.kino_id INNER JOIN standort ON kino.standortid = standort.standort_id INNER JOIN vorstellungssitzplatz ON vorstellungssitzplatz.vorstellungid = vorstellung.vorstellung_id INNER JOIN sitzplatz ON vorstellungssitzplatz.sitzplatzid = sitzplatz.sitzplatz_id
        WHERE vorstellung.vorstellung_id  = '".$selectedVorstellungsID."' AND vorstellungssitzplatz.vorstellungssitzplatz_id = '".$bookedSeats."'");
        $statement->execute();
        $warenkorbDaten = $statement->fetchAll(); 
        $countSeats = 0;
        $countSeats = count($bookedSeats);
    foreach($warenkorbDaten AS $results){
        $gesamtpreis = $countSeats * $results[$i]['vorstellung.grundpreis'];
    }
    for($i = 0; $i < count($warenkorbDaten, COUNT_NORMAL); $i++){
        $ausgewaehlterFilmtitel = $warenkorbDaten[$i]['film.titel'];
        $$ausgewaehlterFilmtitel = new Warenkorb($warenkorbDaten[$i]["film.titel"],$warenkorbDaten[$i]["vorstellung.datum"],$warenkorbDaten[$i]["vorstellung.uhrzeit"], $warenkorbDaten[$i]["sitzplatz.sitzplatz_nummer"], $warenkorbDaten[$i]["sitzplatz.reihe"], $warenkorbDaten[$i]["vorstellung.grundpreis"], $gesamtpreis, $warenkorbDaten[$i]["standort.stadt"], $warenkorbDaten[$i]["vorstellung.is3d"]);
        $this->warenkorb[$ausgewaehlterFilmtitel] = $$ausgewaehlterFilmtitel;
    }
    return $this->warenkorb;
    }*/

    public function storniereBuchung($vorstellungID, $pdfID){
        $statement = $this->connection->prepare("UPDATE  rechnung SET storno = true WHERE vorstellungid = '{$vorstellungID}' AND pdf_id = '{$pdfID}';");
        $statement->execute();
    }

}

?>
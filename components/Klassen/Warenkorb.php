<?php

class Warenkorb {

    private $ausgewaehlterFilmtitel;
    private $ausgewaehltesVorstellungsdatum;
    private $ausgewaehlteVorstellungsUhrzeit;
    private $ausgewaehlteSitzplatznummer = array();
    private $ausgewaehlteSitzplatzreihe = array();
    private $preisProAusgewaehlterSitzplatz;
    private $ausgewaehlteAngebote = array();
    private $gesamtPreisWarenkorb;
    private $ausgewaehlterStandort;
    private $ausgewaehlteVorstellungsDimension;

    public function __construct($film, $datum, $uhrzeit, $sitznummer,$sitzreihe, $preisProSitzplatz, $gesamtpreis, $standort,$dimension)
    {
        $this->ausgewaehlterFilmtitel = $film;
        $this->ausgewaehltesVorstellungsdatum = $datum;
        $this->ausgewaehlteVorstellungsUhrzeit = $uhrzeit;
        $this->ausgewaehlteSitzplatznummer = $sitznummer;
        $this->ausgewaehlteSitzplatzreihe = $sitzreihe;
        $this->preisProAusgewaehlterSitzplatz = $preisProSitzplatz;
       // $this->ausgewaehlteAngebote = $angebote;
        $this->gesamtPreisWarenkorb = $gesamtpreis;
        $this->ausgewaehlterStandort = $standort;
        $this->ausgewaehlteVorstellungsDimension = $dimension;
    }

    public function getAusgewaehlterFilmtitel(){
        return $this->ausgewaehlterFilmtitel;
    }


    public function getAusgewaehltesVorstellungsdatum(){
        return $this->ausgewaehltesVorstellungsdatum;
    }

    public function getAusgewaehlteVorstellungsUhrzeit(){
        return $this->ausgewaehlteVorstellungsUhrzeit;
    }

    public function getAusgewaehlteSitzplatznummer(){
        return $this->ausgewaehlteSitzplatznummer;
    }

    public function getAusgewaehlteSitzplatzreihe(){
        return $this->ausgewaehlteSitzplatzreihe;
    }

    public function getPreisProAusgewaehlterSitzplatz(){
        return $this->preisProAusgewaehlterSitzplatz;
    }
/*
    public function getAusgewaehlteAngebote(){
        return $this->ausgewaehlteAngebote;
    }*/

    public function getGesamtpreisWarenkorb(){
        return $this->gesamtPreisWarenkorb;
    }

    public function getAusgewaehlterStandort(){
        return $this->ausgewaehlterStandort;
    }

    public function getAusgewaehlteVorstellungsDimension(){
        return $this->ausgewaehlteVorstellungsDimension;
    }















}

?>
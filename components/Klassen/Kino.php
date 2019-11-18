<?php

class Kino {

    private $kinoId;
    private $hausnummer;
    private $strasse;
    private $bezeichnung;
    private $stadt;
    private $plz;

    /**
     * Kino constructor.
     * @param $kinoId
     * @param $hausnummer
     * @param $strasse
     * @param $bezeichnung
     * @param $standortId
     * @param $stadt
     * @param $plz
     */
    public function __construct($kinoId, $hausnummer, $strasse, $bezeichnung,$stadt,$plz)
    {
        $this->kinoId = $kinoId;
        $this->hausnummer =  $hausnummer;
        $this->strasse =  $strasse;
        $this->bezeichnung =  $bezeichnung;
        $this->stadt = $stadt;
        $this->plz = $plz;

    }


    /**
     * @return mixed
     */
    public function getKinoId()
    {
        return $this->kinoId;
    }

    /**
     * @return mixed
     */
    public function getHausnummer()
    {
        return $this->hausnummer;
    }

    /**
     * @return mixed
     */
    public function getStrasse()
    {
        return $this->strasse;
    }

    /**
     * @return mixed
     */
    public function getBezeichnung()
    {
        return $this->bezeichnung;
    }

    /**
     * @return mixed
     */
    public function getStadt()
    {
        return $this->stadt;
    }

    /**
     * @return mixed
     */
    public function getPlz()
    {
        return $this->plz;
    }
}

?>
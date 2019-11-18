<?php
class Rechnung{

    private $rechnungsID;
    private $storno;
    private $ausstellungsdatum;
    private $bezahlmethode;
    private $userid;
    private $vorstellungsid;

    public function __construct($rechnungsID, $storno, $ausstellungsdatum, $bezahlmethode,$userid,$vorstellungsid){
        $this->rechnungsID = $rechnungsID;
        $this->storno = $storno;
        $this->ausstellungsdatum = $ausstellungsdatum;
        $this->bezahlmethode = $bezahlmethode;
        $this->userid = $userid;
        $this->vorstellungsid =$vorstellungsid;
    }

    /**
     * @return mixed
     */
    public function getUserid()
    {
        return $this->userid;
    }

    /**
     * @param mixed $userid
     */
    public function setUserid($userid): void
    {
        $this->userid = $userid;
    }

    /**
     * @return mixed
     */
    public function getVorstellungsid()
    {

        return $this->vorstellungsid;
    }

    /**
     * @param mixed $vorstellungsid
     */
    public function setVorstellungsid($vorstellungsid): void
    {
        $this->vorstellungsid = $vorstellungsid;
    }

    public function getRechnungsID(){
        return $this->rechnungsID;
    }

    public function getStorno(){
        return $this->storno;
    }

    public function getAusstellungsdatum(){
        return $this->ausstellungsdatum;
    }

    public function getBezahlmethode(){
        return $this->bezahlmethode;
    }

    public function setRechnungsID($rechnungsID): void
    {
            $this->rechnungsID = $rechnungsID;
    }

    public function setStorno($storno): void
    {
            $this->storno = $storno;
    }

    public function setAusstellungsdatum($ausstellungsdatum): void
    {
            $this->ausstellungsdatum = $ausstellungsdatum;
    }

    public function setBezahlmethode($bezahlmethode): void
    {
            $this->bezahlmethode = $bezahlmethode;
    }

/*
    public function speichereBuchung()
    {



    }*/

}
?>
<?php

//use Vorstellungssitzplatz;

class Kinosaal
{

    private $kinosaalID;
    private $bezeichnung;
    private $laenge;
    private $breite;

    /**
     * Kinosaal constructor.
     * @param $kinosaalID
     * @param $bezeichnung
     * @param $laenge
     * @param $breite
     */
    public function __construct($kinosaalID, $bezeichnung, $laenge, $breite)
    {
        $this->kinosaalID = $kinosaalID;
        $this->bezeichnung = $bezeichnung;
        $this->laenge = $laenge;
        $this->breite = $breite;
    }

    /**
     * @return mixed
     */
    public function getKinosaalID()
    {
        return $this->kinosaalID;
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
    public function getLaenge()
    {
        return $this->laenge;
    }

    /**
     * @return mixed
     */
    public function getBreite()
    {
        return $this->breite;
    }


}

?>
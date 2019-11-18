<?php

class Film {

    private $filmID;
    private $titel;
    private $filmlaenge;
    private $fsk;
    private $erscheinungsDatum;
    private $beschreibung;
    private $bild;
    private $banner;
    private $genre;
    private $trailer;

    /**
     * Film constructor.
     * @param $filmID
     * @param $titel
     * @param $filmlaenge
     * @param $fsk
     * @param $erscheinungsDatum
     * @param $beschreibung
     * @param $bild
     * @param $banner
     * @param $trailer
     * @param $genre
     */
    public function __construct($filmID, $titel, $filmlaenge, $fsk, $erscheinungsDatum, $beschreibung, $bild, $banner, $trailer, $genre)
    {
        $this->filmID = $filmID;
        $this->titel = $titel;
        $this->filmlaenge = $filmlaenge;
        $this->fsk = $fsk;
        $this->erscheinungsDatum = $erscheinungsDatum;
        $this->beschreibung = $beschreibung;
        $this->bild = $bild;
        $this->banner = $banner;
        $this->trailer = $trailer;
        $this->genre = $genre;
        
    }

    /**
     * @return mixed
     */
    public function getTrailer()
    {
        return $this->trailer;
    }

    /**
     * @return mixed
     */
    public function getFilmID()
    {
        return $this->filmID;
    }

    /**
     * @return mixed
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * @return mixed
     */
    public function getFilmlaenge()
    {
        return $this->filmlaenge;
    }

    /**
     * @return mixed
     */
    public function getFsk()
    {
        return $this->fsk;
    }
    
    /**
     * @return mixed
     */
    public function getErscheinungsDatum()
    {
        return $this->erscheinungsDatum;
    }

    /**
     * @return mixed
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * @return mixed
     */
    public function getBild()
    {
        return $this->bild;
    }

    /**
     * @return mixed
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

}

?>
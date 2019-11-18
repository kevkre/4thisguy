<?php


class Suche
{

    private $filmtitel;
    private $genre;
    private $datum;
    private $kinostandort;
    private $suchergebnisse;

    /**
     * Suche constructor.
     * @param $filmtitel
     * @param $genre
     * @param $datum
     * @param $kinostandort
     * @param $suchergebnis
     */
    public function __construct($filmtitel, $genre, $datum, $kinostandort, $suchergebnisse)
    {
    $this->filmtitel = $filmtitel;
    $this->genre = $genre;
    $this->datum = $datum;
    $this->kinostandort = $kinostandort;
    $this->suchergebnisse = $suchergebnisse;
    }
/*
    public function __destruct()
    {
        // TODO: Implement __destruct() method.
    }*/

    /**
     * @return mixed
     */
    public function getFilmtitel()
    {
        return $this->filmtitel;
    }
/*
    public function getParameterUndErstelleVorstellungen()
    {
        

    }*/
    /**
     * @param mixed $filmtitel
     */
    public function setFilmtitel($filmtitel): void
    {
        $this->filmtitel = $filmtitel;
    }

    /**
     * @return mixed
     */
    public function getGenre()
    {
        return $this->genre;
    }

    /**
     * @param mixed $genre
     */
    public function setGenre($genre): void
    {
        $this->genre = $genre;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @param mixed $datum
     */
    public function setDatum($datum): void
    {
        $this->datum = $datum;
    }

    /**
     * @return mixed
     */
    public function getKinostandort()
    {
        return $this->kinostandort;
    }

    /**
     * @param mixed $kinostandort
     */
    public function setKinostandort($kinostandort): void
    {
        $this->kinostandort = $kinostandort;
    }

    /**
     * @return mixed
     */
    public function getSuchergebnisse()
    {
        return $this->suchergebnisse;
    }

    /**
     * @param mixed $ergebnis
     */
    public function setSuchergebnisse($Suchergebniss): void
    {
        $this->suchergebnisse = $Suchergebniss;
    }
    
}
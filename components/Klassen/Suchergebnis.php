<?php

//use Kinosaal;

class Suchergebnis
{

    private $film;
    private $vorstellungen = array();

public function __construct($vorstellung, $film){
    $this->vorstellungen[] = $vorstellung;
    $this->film = $film;
}

public function vorstellungHinzufügen($vorstellung) {
    $this->vorstellungen[] = $vorstellung;
}
/**
 * Getter for Film
 *
 * @return [type]
 */
public function getFilm()
{
    return $this->film;
}

/**
 * Setter for Film
 * @var [type] film
 *
 * @return self
 */
public function setFilm($film)
{
    $this->film = $film;
    return $this;
}


    /**
     * Getter for Vorstellungen
     *
     * @return [type]
     */
    public function getVorstellungen()
    {
        return $this->vorstellungen;
    }

    /**
     * Setter for Vorstellungen
     * @var [type] vorstellungen
     *
     * @return self
     */
    public function setVorstellungen($vorstellungen)
    {
        $this->vorstellungen = $vorstellungen;
        return $this;
    }






}

?>
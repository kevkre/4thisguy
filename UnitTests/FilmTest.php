<?php

use PHPUnit\Framework\TestCase;

class FilmTest extends TestCase
{

    private $film;

    public function setUp(): void
    {

        //include_once("./components/Klassen/Film.php");

        $this->film = new Film(1, "Titel", "Länge", "FSK", "Erscheinungsdatum", "Beschreibung", "Bild", "Banner", "Trailer", array("Genre1", "Genre2"));

    }

    /**@test */
    public function test_get_filmid()
    {

        $filmid = $this->film->getFilmID();
        $this->assertEquals(1, $filmid);

    }

    /**@test */
    public function test_get_filmlaenge()
    {

        $filmlaenge = $this->film->getFilmlaenge();
        $this->assertEquals("Länge", $filmlaenge);

    }

    /**@test */
    public function tes_get_trailer()
    {

        $trailer = $this->film->getTrailer();
        $this->assertEquals("Trailer", $trailer);

    }

    /**@test */
    public function test_get_fsk()
    {

        $fsk = $this->film->getFsk();
        $this->assertEquals("FSK", $fsk);

    }

    /**@test */
    public function test_get_titel()
    {

        $titel = $this->film->getTitel();
        $this->assertEquals("Titel", $titel);

    }

    /**@test */
    public function test_get_erscheinungsdatum()
    {

        $erscheinungsdatum = $this->film->getErscheinungsDatum();
        $this->assertEquals("Erscheinungsdatum", $erscheinungsdatum);

    }

    /**@test */
    public function test_get_trailer()
    {

        $trailer = $this->film->getTrailer();
        $this->assertEquals("Trailer", $trailer);

    }

    /**@test */
    public function test_get_banner()
    {

        $banner = $this->film->getBanner();
        $this->assertEquals("Banner", $banner);

    }

    /**@test */
    public function test_get_bild()
    {

        $bild = $this->film->getBild();
        $this->assertEquals("Bild", $bild);

    }

    /**@test */
    public function test_get_genre()
    {

        $genre = $this->film->getGenre();
        $this->assertEquals(array("Genre1", "Genre2"), $genre);

    }

    /**@test */
    public function test_get_beschreibung()
    {

        $beschreibung = $this->film->getBeschreibung();
        $this->assertEquals("Beschreibung", $beschreibung);

    }

}

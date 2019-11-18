<?php


use PHPUnit\Framework\TestCase;

class SucheTest extends TestCase
{

    private $suche;

    public function setUp():void
    {

        //include_once("./components/Klassen/Suche.php");

        $this->suche = new Suche("Film", "Genre", "Datum", "Kinostandort", "Suchergebnisse");
    }

    /**@test */
    public function test_get_Filmtitel()
    {

        $filmtitel = $this->suche->getFilmtitel();
        $this->assertEquals("Film", $filmtitel);

    }

    /**@test */
    public function test_set_Filmtitel()
    {

        $this->suche->setFilmtitel("new");
        $this->assertEquals("new", $this->suche->getFilmtitel());

    }

    /**@test */
    public function test_get_Genre()
    {

        $Genre = $this->suche->getGenre();
        $this->assertEquals("Genre", $Genre);

    }

    /**@test */
    public function test_set_Genre()
    {

        $this->suche->setGenre("new");
        $this->assertEquals("new", $this->suche->getGenre());

    }

    /**@test */
    public function test_get_Datum()
    {

        $datum = $this->suche->getDatum();
        $this->assertEquals("Datum", $datum);

    }

    /**@test */
    public function test_set_Datum()
    {

        $this->suche->setDatum("new");
        $this->assertEquals("new", $this->suche->getDatum());

    }

    /**@test */
    public function test_get_Kinostandort()
    {

        $Kinostandort = $this->suche->getKinostandort();
        $this->assertEquals("Kinostandort", $Kinostandort);

    }

    /**@test */
    public function test_set_Kinostandort()
    {

        $this->suche->setKinostandort("new");
        $this->assertEquals("new", $this->suche->getKinostandort());

    }

    /**@test */
    public function test_get_Suchergebnisse()
    {

        $Suchergebnisse = $this->suche->getSuchergebnisse();
        $this->assertEquals("Suchergebnisse", $Suchergebnisse);

    }

    /**@test */
    public function test_set_Suchergebnisse()
    {

        $this->suche->setSuchergebnisse("new");
        $this->assertEquals("new", $this->suche->getSuchergebnisse());

    }

}

?>


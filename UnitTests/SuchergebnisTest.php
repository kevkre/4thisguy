<?php


use PHPUnit\Framework\TestCase;

class SuchergebnisTest extends TestCase
{

    private $Suchergebnis;

    public function setUp():void
    {

        //include_once("./components/Klassen/Suchergebnis.php");

        $this->Suchergebnis = new Suchergebnis(array("Vorstellung", "Vorstellung"), "Film");
    }

    /**@test */
    public function test_get_Film()
    {

        $Film = $this->Suchergebnis->getFilm();
        $this->assertEquals("Film", $Film);

    }

    /**@test */
    public function test_set_Film()
    {

        $this->Suchergebnis->setFilm("new");
        $this->assertEquals("new", $this->Suchergebnis->getFilm());

    }

    /**@test */
    public function test_get_Vorstellungen()
    {

        $vorstellungenArray[] = array("Vorstellung", "Vorstellung");
        $Vorstellungen = $this->Suchergebnis->getVorstellungen();
        $this->assertEquals($vorstellungenArray, $Vorstellungen);

    }

    /**@test */
    public function test_set_Vorstellungen()
    {

        $this->Suchergebnis->setVorstellungen(array("new"));
        $this->assertEquals(array("new"), $this->Suchergebnis->getVorstellungen());

    }

    /**@test */
    public function test_Vorstellung_hinzufügen()
    {
        
        $this->Suchergebnis->vorstellungHinzufügen(array("new"));
        $this->assertEquals(array(array("Vorstellung", "Vorstellung"), array("new")), $this->Suchergebnis->getVorstellungen());

    }

}

?>

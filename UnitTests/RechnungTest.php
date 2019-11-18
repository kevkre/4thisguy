<?php


use PHPUnit\Framework\TestCase;

class RechnungTest extends TestCase
{

    private $rechnung;

    public function setUp():void
    {

        //include_once("./components/Klassen/Rechnung.php");

        $this->rechnung = new Rechnung("ID", "Storno", "Datum", "Bezahlmethode", "User", "Vorstellung");
    }

    /**@test */
    public function test_get_RechnungsID()
    {

        $ID = $this->rechnung->getRechnungsID();
        $this->assertEquals("ID", $ID);

    }

    /**@test */
    public function test_get_Storno()
    {

        $storno = $this->rechnung->getStorno();
        $this->assertEquals("Storno", $storno);

    }

    /**@test */
    public function test_get_Ausstellungsdatum()
    {

        $datum = $this->rechnung->getAusstellungsdatum();
        $this->assertEquals("Datum", $datum);

    }

    /**@test */
    public function test_get_Bezahlmethode()
    {

        $bezahlmethode = $this->rechnung->getBezahlmethode();
        $this->assertEquals("Bezahlmethode", $bezahlmethode);

    }

    /**@test */
    public function test_set_RechnungsID()
    {

        $this->rechnung->setRechnungsID("new");
        $this->assertEquals("new", $this->rechnung->getRechnungsID());

    }

    /**@test */
    public function test_set_Storno()
    {

        $this->rechnung->setStorno("new");
        $this->assertEquals("new", $this->rechnung->getStorno());

    }

    /**@test */
    public function test_set_Ausstellungsdatum()
    {

        $this->rechnung->setAusstellungsdatum("new");
        $this->assertEquals("new", $this->rechnung->getAusstellungsdatum());

    }

    /**@test */
    public function test_set_Bezahlmethode()
    {

        $this->rechnung->setBezahlmethode("new");
        $this->assertEquals("new", $this->rechnung->getBezahlmethode());

    }

    /**@test */
    public function test_get_Userid()
    {

        $ID = $this->rechnung->getUserid();
        $this->assertEquals("User", $ID);

    }

    /**@test */
    public function test_get_Vorstellungsid()
    {

        $ID = $this->rechnung->getVorstellungsid();
        $this->assertEquals("Vorstellung", $ID);

    }

    /**@test */
    public function test_set_Userid()
    {

        $this->rechnung->setUserid("new");
        $this->assertEquals("new", $this->rechnung->getUserid());

    }

    /**@test */
    public function test_set_Vorstellungsid()
    {

        $this->rechnung->setVorstellungsid("new");
        $this->assertEquals("new", $this->rechnung->getVorstellungsid());

    }

}
?>
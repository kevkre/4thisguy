<?php


use PHPUnit\Framework\TestCase;

class KinoTest extends TestCase
{

    private $kino;

    public function setUp():void
    {

        //include_once("./components/Klassen/Kino.php");

        $this->kino = new Kino("ID", "Hausnummer", "Strasse", "Bezeichnung", "Stadt", "PLZ");

    }

    /**@test */
    public function test_get_KinoID()
    {

        $ID = $this->kino->getKinoID();
        $this->assertEquals("ID", $ID);

    }

    /**@test */
    public function test_get_Hausnummer()
    {

        $hausnummer = $this->kino->getHausnummer();
        $this->assertEquals("Hausnummer", $hausnummer);

    }

    /**@test */
    public function test_get_Strasse()
    {

        $strasse = $this->kino->getStrasse();
        $this->assertEquals("Strasse", $strasse);

    }

    /**@test */
    public function test_get_Bezeichnung()
    {

        $bezeichnung = $this->kino->getBezeichnung();
        $this->assertEquals("Bezeichnung", $bezeichnung);

    }

    /**@test */
    public function test_get_Stadt()
    {

        $stadt = $this->kino->getStadt();
        $this->assertEquals("Stadt", $stadt);

    }

    /**@test */
    public function test_getPLZ()
    {

        $plz = $this->kino->getPLZ();
        $this->assertEquals("PLZ", $plz);

    }

}
?>
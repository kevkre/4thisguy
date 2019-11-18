<?php


use PHPUnit\Framework\TestCase;

class KinosaalTest extends TestCase
{

    private $kinosaal;

    public function setUp():void
    {

        //include_once("./components/Klassen/Kinosaal.php");

        $this->kinosaal = new Kinosaal("ID", "Bezeichnung", "Laenge", "Breite");

    }

    /**@test */
    public function test_get_KinosaalID()
    {

        $ID = $this->kinosaal->getKinosaalID();
        $this->assertEquals("ID", $ID);

    }

    /**@test */
    public function test_get_Bezeichnung()
    {

        $bezeichnung = $this->kinosaal->getBezeichnung();
        $this->assertEquals("Bezeichnung", $bezeichnung);

    }

    /**@test */
    public function test_get_Laenge()
    {

        $laenge = $this->kinosaal->getLaenge();
        $this->assertEquals("Laenge", $laenge);

    }

    /**@test */
    public function test_get_Breite()
    {

        $breite = $this->kinosaal->getBreite();
        $this->assertEquals("Breite", $breite);

    }

}
?>
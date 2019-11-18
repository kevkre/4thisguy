<?php


use PHPUnit\Framework\TestCase;

class VorstellungssitzplatzTest extends TestCase
{

    private $Vorstellungssitzplatz;

    public function setUp():void
    {

        //include_once("./components/Klassen/Vorstellungssitzplatz.php");

        $this->Vorstellungssitzplatz = new Vorstellungssitzplatz("ID", "belegt", "Reihe", "premiumsitzplatz");
    }

    // TODO: tests für premiumsitzplatz noch implemntieren 

    /**@test */
    public function test_get_VorstellungssitzplatzID()
    {

        $ID = $this->Vorstellungssitzplatz->getVorstellungssitzplatzID();
        $this->assertEquals("ID", $ID);

    }

    /**@test */
    public function test_get_Reihe()
    {

        $Reihe = $this->Vorstellungssitzplatz->getReihe();
        $this->assertEquals("Reihe", $Reihe);

    }

    /**@test */
    public function test_set_Reihe()
    {

        $this->Vorstellungssitzplatz->setReihe("new");
        $this->assertEquals("new", $this->Vorstellungssitzplatz->getReihe());

    }

    /**@test */
    public function test_get_Belegt()
    {

        $belegt = $this->Vorstellungssitzplatz->getBelegt();
        $this->assertEquals("belegt", $belegt);

    }

    /**@test */
    public function test_get_premium()
    {

        $this->assertEquals("premiumsitzplatz", $this->Vorstellungssitzplatz->getPremium());

    }

    /**@test */
    public function test_set_Belegt()
    {

        $this->Vorstellungssitzplatz->setPremium("new");
        $this->assertEquals("new", $this->Vorstellungssitzplatz->getPremium());

    }

}

?>

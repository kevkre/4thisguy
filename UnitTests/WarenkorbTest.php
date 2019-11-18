<?php


use PHPUnit\Framework\TestCase;

class WarenkorbTest extends TestCase
{

    private $Warenkorb;

    public function setUp():void
    {

        //include_once("./components/Klassen/Warenkorb.php");

        $this->Warenkorb = new Warenkorb("Film", "Datum", "Uhrzeit", "Sitznummer", "Sitzreihe", "Preis pro Sitzplatz", "Gesamtpreis", "Standort", "Dimension");
    }

    /**@test */
    public function test_get_Film()
    {

        $Film = $this->Warenkorb->getAusgewaehlterFilmtitel();
        $this->assertEquals("Film", $Film);

    }

    /**@test */
    public function test_get_Datum()
    {

        $Datum = $this->Warenkorb->getAusgewaehltesVorstellungsdatum();
        $this->assertEquals("Datum", $Datum);

    }

    /**@test */
    public function test_get_Sitzplatzreihe()
    {

        $Reihe = $this->Warenkorb->getAusgewaehlteSitzplatzreihe();
        $this->assertEquals("Sitzreihe", $Reihe);

    }

    /**@test */
    public function test_get_Preis_pro_Sitzplatz()
    {

        $Preis = $this->Warenkorb->getPreisProAusgewaehlterSitzplatz();
        $this->assertEquals("Preis pro Sitzplatz", $Preis);

    }


    /**@test */
    public function test_get_Sitzplatznummer()
    {

        $Sitznummer = $this->Warenkorb->getAusgewaehlteSitzplatznummer();
        $this->assertEquals("Sitznummer", $Sitznummer);

    }

    /**@test */
    public function test_get_Uhrzeit()
    {

        $Uhrzeit = $this->Warenkorb->getAusgewaehlteVorstellungsUhrzeit();
        $this->assertEquals("Uhrzeit", $Uhrzeit);

    }

    /**@test */
    public function test_get_Gesamtpreis()
    {

        $Gesamtpreis = $this->Warenkorb->getGesamtpreisWarenkorb();
        $this->assertEquals("Gesamtpreis", $Gesamtpreis);

    }

    /**@test */
    public function test_get_Standort()
    {
        
        $Standort = $this->Warenkorb->getAusgewaehlterStandort();
        $this->assertEquals("Standort", $Standort);

    }

    /**@test */
    public function test_get_Dimension()
    {
        
        $Dimension = $this->Warenkorb->getAusgewaehlteVorstellungsDimension();
        $this->assertEquals("Dimension", $Dimension);

    }
}
?>
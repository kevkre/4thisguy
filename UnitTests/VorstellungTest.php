<?php


use PHPUnit\Framework\TestCase;

class VorstellungTest extends TestCase
{

    private $vorstellung;

    public function setUp(): void
    {

        //include_once("C:/xampp/htdocs/components/Klassen/Vorstellung.php");
        
        $this->vorstellung = new Vorstellung("ID", "Länge", "Datum", true, "Uhrzeit", "Beschreibung", "Grundpreis", "Film", "Kinosaal", "Vorstellungssitzplatz");

    }

    /** @test */
    public function test_get_VorstellungId()
    {

        $this->assertEquals("ID", $this->vorstellung->getVorstellungsID());

    }

    /** @test */
    public function test_get_Vorstellung_Laenge()
    {

        $this->assertEquals("Länge", $this->vorstellung->getVorstellungsLaenge());

    }

    /**@test */
    public function test_get_Datum()
    {

        $this->assertEquals("Datum", $this->vorstellung->getDatum());
    
    }

    /**@test */
    public function test_get_Dreidimensional()
    {

        $this->assertEquals(true, $this->vorstellung->getDreiDimensional());
    
    }

    /**@test */
    public function test_get_Uhrzeit()
    {

        $this->assertEquals("Uhrzeit", $this->vorstellung->getUhrzeit());
    
    }

    /**@test */
    public function test_get_Beschreibung()
    {

        $this->assertEquals("Beschreibung", $this->vorstellung->getBeschreibung());
    
    }

    /**@test */
    public function test_get_Grundpreis()
    {

        $this->assertEquals("Grundpreis", $this->vorstellung->getGrundpreis());
    
    }

    /**@test */
    public function test_get_FilmID()
    {

        $this->assertEquals("Film", $this->vorstellung->getFilmID());
    
    }

    /**@test */
    public function test_get_KinosaalID()
    {

        $this->assertEquals("Kinosaal", $this->vorstellung->getKinosaalID());
    
    }

    /**@test */
    public function test_get_Vorstellungssitzplatz()
    {

        $this->assertEquals("Vorstellungssitzplatz", $this->vorstellung->getVorstellungsSitzplaetze());

    }

    /**@test */
    public function test_get_Dimension_3d()
    {

        $this->assertEquals("3D", $this->vorstellung->getDimension());

    }

    /**@test */
    public function test_get_Dimension_2d()
    {

        $this->vorstellung = new Vorstellung("ID", "Länge", "Datum", false, "Uhrzeit", "Beschreibung", "Grundpreis", "Film", "Kinosaal", "Vorstellungssitzplatz");

        $this->assertEquals("2D", $this->vorstellung->getDimension());

    }

}

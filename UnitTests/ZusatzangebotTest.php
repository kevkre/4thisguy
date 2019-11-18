<?php

use PHPUnit\Framework\TestCase;

class ZusatzangebotTest extends TestCase
{

    private $zusatzangebot;

    public function setUp(): void
    {

        //include_once("./components/Klassen/Zusatzangebot.php");
        
        $this->zusatzangebot = new Zusatzangebot("ID", "UUID", "Preis", "Titel", "Beschreibung");

    }
    
    /**@test */
    public function test_get_ZusatzangeboteID()
    {

        $ID = $this->zusatzangebot->getZusatzangeboteID();
        $this->assertEquals("ID", $ID);

    }

    /**@test */
    public function test_get_Preis()
    {
        $UUID = $this->zusatzangebot->getUuid();
        $this->assertEquals("UUID", $UUID);

    }

    /**@test */
    public function test_get_Uuid()
    {
        $preis = $this->zusatzangebot->getPreis();
        $this->assertEquals("Preis", $preis);

    }

    /**@test */
    public function test_get_Beschreibung()
    {

        $beschreibung = $this->zusatzangebot->getBeschreibung();
        $this->assertEquals("Beschreibung", $beschreibung);

    }

    /**@test */
    public function test_get_Titel()
    {
        $titel = $this->zusatzangebot->getTitel();
        $this->assertEquals("Titel", $titel);

    }
}

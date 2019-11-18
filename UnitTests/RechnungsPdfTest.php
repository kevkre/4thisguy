<?php


use PHPUnit\Framework\TestCase;

class RechnungsPdfTest extends TestCase
{

    private $rechnungspdf;

    public function setUp():void
    {

        //include_once("./components/Klassen/RechnungsPdf.php");

        $this->rechnungspdf = new RechnungsPdf("nummer", "datum", "author", "posten", "umsatzsteuer", "name", "gesamtpreis", "empfänger");

    }

    /**@test */
    public function test_constructor(){

        $this->assertEquals(new RechnungsPdf("nummer", "datum", "author", "posten", "umsatzsteuer", "name", "gesamtpreis", "empfänger"), $this->rechnungspdf);

    }

}
?>
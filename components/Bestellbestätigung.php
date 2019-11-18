<?php

$_SESSION["sitename"] = "Bestellbestätigung";

function getcontent($page)
{
    include_once($_SERVER['DOCUMENT_ROOT']. "/components/Klassen/Rechnung.php");
    include_once($_SERVER['DOCUMENT_ROOT']. "/components/Klassen/RechnungsPdf.php");
    global $aktuellesProgramm,$Sitze;
    $aktuellesProgramm->aktualisieren();
    for($i = 0;$i < count($Sitze);$i++){
    $aktuellesProgramm->setSitzplatzBelegt($Sitze[$i]);
        //Erstellung der Bestellbestätigungsseite
    }
        echo '

<div class="container">
        <div class="row">
            <div class="col-12 col-centered">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="card-content col-12">
                                <div class="BestellText">
                                <h2 class=margintop> Vielen Dank für deine Bestellung! </h2>
                                 ';
    //Un-serializieren der Rechnungsobekte um pdf zu erstellen
                                $object = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Bestellungen/serializedBestellung.php');
                                $rechnungsobjekt = file_get_contents($_SERVER['DOCUMENT_ROOT'].'/Bestellungen/serializedRechnungen.php');
                                $rechnung = unserialize($rechnungsobjekt);
                                $aktuellesProgramm->speichereRechnung($rechnung->getRechnungsID(),$rechnung->getStorno(),$rechnung->getAusstellungsdatum(),$rechnung->getBezahlmethode(),$rechnung->getUserid(),$rechnung->getVorstellungsid());
                                $Pdf = unserialize($object);
                                $Pdf->erstellePdf();
       echo'
                              </div>
                                <div class=ButtonRahmen>
                                    <div class="ButtonMitte">
                                        <a href="./?page=Suche" class="btn btn-secondary btn-lg btn-block btn-shadow" role="button">Zur Filmsuche</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
';
}


?>
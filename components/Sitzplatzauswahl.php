<?php
 include_once($_SERVER['DOCUMENT_ROOT']. "/components/Klassen/Vorstellung.php");
$_SESSION["sitename"] = "Sitzplatzauswahl";

function getcontent($page)
{
    //Erstellen der Sitzplatzauswahl
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    if (strcasecmp($page, "Sitzplatzauswahl") == 0) {


        if (!isset($_GET["Vorstellungs_id"])) {
        } else {

            $film_id = $_GET["Vorstellungs_id"];
            $event_id = isset($_GET["Event_id"]) ? $_GET["Event_id"] : null;
        }
        $vorstellung = new Vorstellung(4, 120, 2019 - 05 - 06, 0, "", "", 7, 2, 1,$aktuellesProgramm->getConnection());
        $anzahlReihen = 0;
        foreach ($vorstellung->getVorstellungsSitzplaetze() as $v) {
            if (($v->getReihe()) > $anzahlReihen) {
                $anzahlReihen = $v->getReihe();
            }
        }
        include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Saalplan.php");
    }
}
?>


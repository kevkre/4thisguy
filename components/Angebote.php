<?php

$_SESSION["sitename"] = "unsere Deals";
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Zusatzangebot.php");
function getcontent($page)
{//dynamisches erstellen der Angebotsseite
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    if (strcasecmp($page, "angebote") == 0) {
        echo '<div class="container">
        <div class="row">
            <h2> für ein vollständiges Unterhaltungserlebnis: </h2>
        </div>
        <div class="row">';

        $count = 0;
// hole dir alle Angebote
        foreach($aktuellesProgramm->gibAlleAngebotsDaten() AS $angebotsliste){
            echo '  
            <div class="col-3 card card25">
                <div class="card-content">
                    <img class="img-fluid" src="'.$angebotsliste->getUuid().'">
                    <p>'.$angebotsliste->getBeschreibung().'</p>
                </div>       
            </div>
        ';

        }

        echo '</div>
        </div>';
    }
} 
?>


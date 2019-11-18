<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Kino.php");
$_SESSION["sitename"] = "unsere Standorte";
//Standorte dyanmisch erstellen
function getcontent($page){
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    if( strcasecmp($page,"standorte") == 0){
    echo '
    <div class="container">
    <div class="row">
    <h2> alle Kinostandorte auf einen Blick: </h2>
    </div>
    <div class="row">';

    foreach($aktuellesProgramm->gibAlleKinoDaten() as $standortliste){

        echo '
        <div class="col-3">
            <div class="card">
                <div class="card-content">
                    <h3>'.$standortliste->getStadt().'</h3>
                </div>
            </div>
        </div> 
    ';}
    echo '</div>
    </div>';
    }
}
?>
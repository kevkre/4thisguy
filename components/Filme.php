<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Film.php");
$_SESSION["sitename"] = "aktuelle Filme";
//dynamisches Anzeigen aller aktuellen Filme in der Datenbank
function getcontent($page){
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    if( strcasecmp($page,"filme") == 0){
    echo
    '
       <div class="container">
       
    <div class="row">
    <h2> alle aktuellen Filme: </h2>
    </div>
    <div class ="row">';
    //Anzeige aller Filme aus DB
    foreach($aktuellesProgramm->gibAlleFilmDaten() AS $filmliste) {
        echo '
        <div class="col-3 card card25"> 
            <div class=card-content>   
               <a href="./?page=FilmDetails&Film_id=' . $filmliste->getFilmID() . '" > <img class="img-fluid shadow" src="' . $filmliste->getBild() . '" > </a>
                <div class="margintop filmtitel">
                    <h3>' . $filmliste->getTitel() . '</h3>
                </div>
            </div>
        </div>
        ';
    }
     echo '</div>
    </div>
    ';
    }
}

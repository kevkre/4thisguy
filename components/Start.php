<?php

$_SESSION["sitename"] = "Home";
//Startseite für Website erstellen
function getcontent($page){
    // Banner für Startseite erhalten
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();

    if( strcasecmp($page,"start") == 0){

        $anzahlBanner = 3;

        $count = 0;

        $filme = $aktuellesProgramm->getBannerNachHaeufigkeit($anzahlBanner);

        echo '

        <div id="carousel-example-1z" class="carousel slide carousel-fade" data-ride="carousel">
            <!--Indicators-->
            <ol class="carousel-indicators">
                <li data-target="#carousel-example-1z" data-slide-to="0" class="active"></li>
                <li data-target="#carousel-example-1z" data-slide-to="1"></li>
                <li data-target="#carousel-example-1z" data-slide-to="2"></li>
            </ol>
            <!--/.Indicators-->
            <!--Slides-->
            <div class="carousel-inner" role="listbox">';

                foreach ($filme as $f) {

                    echo ' 
                    
                    
                    <div class="carousel-item';

                    if ($count == 0){

                        echo ' active';

                    }
                    
                    echo '">
                        <a href="./?page=FilmDetails&Film_id=' . $f->getFilmID() . '" >
                        <img class="d-block w-100 img-fluid" src="'. $f->getBanner() . '" alt="'. $f->getTitel() .'">
                        </a>
                    </div>
                    ';

                    $count++;

                }

                echo '
            </div>
            <!--/.Slides-->
            <!--Controls-->
            <a class="carousel-control-prev" href="#carousel-example-1z" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel-example-1z" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <!--/.Controls-->
        </div>

        <div class=ButtonRahmen>
        <div class="ButtonMitte">
        <a href="./?page=Suche" class="btn btn-secondary btn-lg btn-block btn-shadow" role="button">Zur Filmsuche</a>  
        </div>
        </div>
        ';
    }
}
    ?>
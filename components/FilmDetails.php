<?php

$_SESSION["sitename"] = "FilmDetails";

function getcontent($page)
{
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
//Wenn es die Filmdetailsseite gibt führe aus
    if (strcasecmp($page, "FilmDetails") == 0) {

            $film_id = $_GET["Film_id"];
            $film = $aktuellesProgramm->getFilmMitFilmId($film_id);
            $genre = $film->getGenre();
            //Generieren der Filmdetails
        echo '<div class="container">
        <div class="row">
            <div class="col-12 col-centered">
                <div class="card">
                    <div class="container">
    
                        <div class="row">
                            <div class="card-content col-3">
                                <img class="img-fluid shadow" src="'.$film->getBild().'">
                            </div>
                            
                            <div class="card-content col-4">
                                <h2>'.$film->getTitel().'</h2>
                                <p> '.$film->getBeschreibung().' </p>
    
                            </div>
                            <div class="col-5">
                                <div class="container">
                                    <div class="card-content">
                                        <div class="margintop">
                                            <p>Genre:</p>
                                        </div>';

                                    foreach ($genre as $v) {                                  

                                        echo '
                                        
                                        <div class="GenreRahmen">
                                            <p>'.$v["bezeichnung"].' </p>
                                        </div>';

                                    }


                                        echo '
                   
                                        <div class="margintop">
                                            <p>Verfügbar in:</p>
                                        </div>
                                        <div class="GenreRahmen">
                                            <p>2D</p>
                                        </div>
                                        <div class="GenreRahmen">
                                            <p>3D</p>
                                            
                                        </div>
                                        <iframe width=100% height=300rm src="'.$film->getTrailer().'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                       <p></p>
                                        <a href="./?page=Suche" class="btn btn-secondary btn-sm FilmdetailsButton shadow" role="button">Zurück zur Suche</a>
                    
                                    </div>
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
}

?>
<?php

$_SESSION["sitename"] = "Suche";

function getcontent($page)
{
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    //$aktuellesProgramm->sucheVorstellungen(array("datum"=>"2019-02-22", "stadt"=>"britz"));
    //echo count($aktuellesProgramm->getFilme());
    //echo count($aktuellesProgramm->getSuchergebnisse());
    //foreach ($aktuellesProgramm->getFilme() AS $key => $value) {
    //   echo $key;
    //}
    if (strcasecmp($page, "suche") == 0) {
        //print_r($aktuellesProgramm->getDatenGesuchteVorstellungen());
        echo '<div class="container">';

        include_once("./components/Suche/SuchLeiste.php");

        if($aktuellesProgramm->getWurdeDurchsucht()==true){

            if(!empty($aktuellesProgramm->getSuchergebnisse())){

            echo '
            <div class="row">
                <h4> Suchergebnisse: </h4>
            </div>';
            }
            //Wenn keine Vorstellungen gefunden wurden
            else {
            echo '
            <div class="row">
            <h4> Leider wurden keine Vorstellungen gefunden. Versuche es erneut mit anderen Kriterien! </h4>
            </div>';
        }}

//dynamisch Vorstellungen generieren
        foreach ($aktuellesProgramm->getSuchergebnisse() as $suchergebnis) {
            $genres = $suchergebnis->getFilm()->getGenre();
            $vorstellungen = $suchergebnis->getVorstellungen();
            foreach ($genres[0] as $v) {
                $wert = $v . " ";
            }
            echo '
          
        <div class="row">
            <div class="col-12 col-centered">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="col-3"> 
       
                               <img class="img-fluid FilmsucheBild shadow" src= ' . $suchergebnis->getFilm()->getBild() . '> 
                            </div>
                            <div class="col-5">
                                <div class="card-content">
                                    <h2 class=left> ' .$suchergebnis->getFilm()->getTitel(). '</h2>                    
                                    <div class="crop">
                                        '. preg_replace("/[^ ]*$/", '', substr($suchergebnis->getFilm()->getBeschreibung(),0,410)).'...
                                    </div>
                                 
                                  
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card-content">
                                    
                                    <p>Genre:</p>
                                    <div class="GenreRahmen">
                                        <p><p> ' . $wert . '
                            </p></p>
                                    </div>
                                    

                                   
                                    <div class="margintop">
                                            <p>Vorstellungen am '.date_format(date_create_from_format('Y-m-d', $suchergebnis->getVorstellungen()[0]->getDatum()), 'd.m.Y').':
                                            </p>
                                    </div>
                                    '
                                    .getContentVorstellungen($suchergebnis).
                                    '
                                        
        
                                          
                                
                            </div>
                            <a href="./?page=FilmDetails&Film_id='.$suchergebnis->getFilm()->getFilmId().'" class="btn btn-secondary btn-sm FilmdetailsButton shadow" role="button">Filmdetails ansehen</a>
                        </div>
                    </div>
                </div>
            
        
        
        </div>';


            }
        }


    }


function getContentVorstellungen($suchergebnis){
    $returnString = '';
    foreach($suchergebnis->getVorstellungen() as $vorstellung){
        $returnString .= 
        '
        <div class="VorstellungRahmen">
                                            <p class="BeschreibungFilmdetail">'.date("G:i ", strtotime($vorstellung->getUhrzeit())). ' Uhr </p>
                                            <p class="BeschreibungFilmdetail"> | </p>
                                            <p class="BeschreibungFilmdetail">'.$vorstellung->getDimension().'</p>
                                            <p class="BeschreibungFilmdetail"> | </p>
                                            <a class="button" class="btn btn-secondary btn-sm" href="./?page=Sitzplatzauswahl&Vorstellungs_id='.$vorstellung->getVorstellungsID().'" role="button">auswählen</a>                        
                                        </div>

        
                                        ';
    }
    return $returnString;

};
?>

<?php
//Warenkorb für user erstellen
$_SESSION["sitename"] = "Warenkorb";
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Zusatzangebot.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Warenkorb.php");
$_SESSION["Sitze"] = $_GET["Sitze"];
function getcontent($page)
{
    include_once($_SERVER['DOCUMENT_ROOT']. "/components/Klassen/RechnungsPdf.php");
    include_once($_SERVER['DOCUMENT_ROOT']. "/components/Klassen/Rechnung.php");
    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();
    $Sitze = json_decode($_GET["Sitze"]);
    $Vorstellungid = $_GET["Vorstellungsid"];
    $vorstellung = $aktuellesProgramm->gibVorstellungById($Vorstellungid);
    $film = $aktuellesProgramm->getFilmMitFilmId($vorstellung->getFilmId());
    if (strcasecmp($page, "Warenkorb") == 0) {


        if (($_SESSION['loggedin'] == false)) {
            echo '<script type="text/javascript"> window.location.href="https://' . DOMAIN . '";</script>';
        } else {
            echo '
<div class="bigger">
    <div class="row">
        <div class="col-12 col-centered">
            <div class="card">
                <div class="bigger">
                    <div class="row">
                        <div class="card-content col-4">
                            <div class="bigger container">
                                <div class="row">
                                    <h3>jetzt zum Super-Preis dazubestellen:</h4>
                                </div>
                                <div class="row">';

            foreach ($aktuellesProgramm->gibAlleAngebotsDaten() as $angebotsliste) {
                echo ' 
                                    <div class="col-6">
                                        <div class="card">
                                            <div class="card-content">
                                                <img class="img-fluid" src="' . $angebotsliste->getUuid() . '">
                                                <p>' . $angebotsliste->getBeschreibung() . '</p>
                                            </div>
                                        </div>
                                    </div>';
            }
            echo '               </div>
                            </div>
                        </div>';
            echo '      <div class="col-8">
                            <h2 class="margintop">Warenkorb</h2>
                            <div class="bigger container">
                                <div class="card-content">
                                    <div class="WarenkorbRahmen"></div>
                        ';
            $rechnungsPosten= Array();
            for ($i = 0; $i < count($Sitze); $i++) {
                $reihe = $aktuellesProgramm->gibReihe($Sitze[$i]);
                $nummer = $aktuellesProgramm->gibSitzplatzNr($Sitze[$i]);
                $gesamtpreis = $aktuellesProgramm->berechneGesamtpreis($vorstellung->getGrundpreis(), count($Sitze));

                $rechnungsPosten[] = array($film->getTitel(),1,$vorstellung->getGrundPreis(),$reihe[0]['reihe'],$nummer[0]['sitzplatz_nummer']);
                        echo '          <div class="row margintop">
                                            <div class="col-3">
                                                <p class="BeschreibungFilmdetail">' . $film->getTitel() . '</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="BeschreibungFilmdetail">' . $vorstellung->getDatum() . '</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="BeschreibungFilmdetail">' . $vorstellung->getUhrzeit() . '</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="BeschreibungFilmdetail">Reihe: ' . $reihe[0]['reihe'] . '</p>
                                            </div>
                                            <div class="col-2">
                                                <p class="BeschreibungFilmdetail">Sitzplatz: ' . $nummer[0]['sitzplatz_nummer'] . '</p>
                                            </div> 
                                            <div class="col-1">
                                                <p class="BeschreibungFilmdetail">' . $vorstellung->getGrundpreis() . '€</p>
                                            </div>
                                            
                                        </div>';
            }// Gesamtpreis erstellen
            $gesamtpreis = $aktuellesProgramm->berechneGesamtpreis($vorstellung->getGrundpreis(), count($Sitze));
            //Pdf erstellen

            echo '                          <div class="WarenkorbdoppelRahmen">
                                            </div>
                                            <div class="WarenkorbdoppelRahmen">
                                            </div>
                                            <div class=row>
                                                <div class="col-3 offset-md-9">
                                                    <p class=""> Gesamtpreis ' . $gesamtpreis. '€</p>
                                                </div>
                                            </div>';

            echo '                          <div class=row>
                                                <div class="col-12">
                                           ';
            $Bestellung = json_encode($_GET["Sitze"]); ?>

            <script>
                var Bestellung = '<?php echo $Bestellung ?>'
            </script>
                                            <a href='./?page=Zahlvorgang' class="btn btn-secondary btn-sm FilmdetailsButton shadow" role="button">jetzt Bestellen</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
            //Buchung und Rechnung erstellen und Objekte serialisieren
            $date = date("Y-m-d");
            $buchungsnummer = date("His");
            $empfaenger = $_SESSION["vorname"]." ".$_SESSION["nachname"];
            $rechnungsPdf = new RechnungsPdf(time(),$date,"Fly-Cinema",$rechnungsPosten,0.19,'Kinoticket-Bestellung'.$buchungsnummer.'.pdf',$gesamtpreis,$empfaenger);
            $rechnung = new Rechnung($buchungsnummer,0,$date,"Kreditkarte",$_SESSION["userId"],$Vorstellungid);

            $serialize = serialize($rechnungsPdf);
            $rechnungSerialize = serialize($rechnung);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Bestellungen/serializedBestellung.php',$serialize);
            file_put_contents($_SERVER['DOCUMENT_ROOT'].'/Bestellungen/serializedRechnungen.php',$rechnungSerialize);
        }

    }
}
?>




<!-- if($warenkorbliste->getAusgewaehlteVorstellungsDimension() == true){
                                   echo '         <p class="BeschreibungFilmdetail">3D</p>';
                 }else{
                                   echo '         <p class="BeschreibungFilmdetail">2D</p>                                        ';
                 }
                  echo '                       </div>
                 <div class="col-2">
                     <p class="BeschreibungFilmdetail">'.$warenkorbliste->getPreisProAusgewaehlterSitzplatz().'</p>
                 </div>
             </div>
         ';*/

                /*    echo '
                       <div class="WarenkorbRahmenUnten margintop"></div>
                       <div class=row>
                           <div class="col-9"></div>
                           <div class="col-3">
                               <h5>'.$warenkorbliste->getGesamtpreisWarenkorb().'</h5>
                           </div>
                       </div>
                       '; -->
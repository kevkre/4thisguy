<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Vorstellung.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Vorstellungssitzplatz.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Kinosaal.php");
global $aktuellesProgramm;
$vorstellung = $aktuellesProgramm->gibVorstellungById($_GET["Vorstellungs_id"]);

$anzahlReihen = 0;
//dynamisches Erstellen des Saalplans
foreach ($vorstellung->getVorstellungsSitzplaetze() as $v) {
    if (($v->getReihe()) > $anzahlReihen) {
        $anzahlReihen = $v->getReihe();
    }
}
?>


<div class="container">
    <div class="row">
        <div class="col-12 col-centered">
       
            <div class="card">
         
                <div class="container">
                
                    <div class="row">
                    <!-- jeweils Sitzplatz generieren -->
                        <div class="col-12 center">
                        <?php
                         foreach($aktuellesProgramm->gibKinoSaalDatenMitVorstellungsId($_GET["Vorstellungs_id"]) AS $kinosaal){
                            echo ' <h3>'.$kinosaal->getBezeichnung().'</h3>';
                         }
            ?>
                                <div class="Saal">
                                <div class=Leinwand></div>
                                    <?php
                                    $vorstellung1 = $vorstellung->getVorstellungsSitzplaetze();
                                   
                                    for ($i = 1; $i < $anzahlReihen + 1; $i++) {
                                        echo '<li class="Sitzreihe Sitzreihe--' . $i . '">' ?>
                                        <ol class="Sitze" type="A">
                                            <?php foreach ($vorstellung1 as $v) {

                                                    if ($v->getPremium() == 0) {

                                                    if ($v->getBelegt() == 1 && $v->getReihe() == $i) {
                                                        echo '
                                                        <li class="Sitz loge">
                                                            <input type="checkbox" disabled value="' . $v->getVorstellungsSitzplatzID() . '" id="' . $v->getVorstellungsSitzplatzID() . '">
                                                            <label class="loge" for="' . $v->getVorstellungsSitzplatzID() . '"> <!-- ' . $v->getVorstellungsSitzplatzID() . '  --> </label>
                                                        </li>';
                                                    } else {
                                                        if ($v->getBelegt() == 0 && $v->getReihe() == $i) {
                                                            echo '
                                                        <li class="Sitz loge">
                                                            <input type="checkbox" value="' . $v->getVorstellungsSitzplatzID() . '" id="' . $v->getVorstellungsSitzplatzID() . '">
                                                            <label class="loge" for="' . $v->getVorstellungsSitzplatzID() . '"> <!-- ' . $v->getVorstellungsSitzplatzID() . '  --> </label>
                                                        </li>';
                                                        }
                                                    }
                                                } else 

                                                {

                                                    if ($v->getBelegt() == 1 && $v->getReihe() == $i) {
                                                        echo '
                                                        <li class="PremiumSitz">
                                                            <input type="checkbox" disabled value="' . $v->getVorstellungsSitzplatzID() . '" id="' . $v->getVorstellungsSitzplatzID() . '">
                                                            <label for="' . $v->getVorstellungsSitzplatzID() . '"> <!-- ' . $v->getVorstellungsSitzplatzID() . '  --> </label>
                                                        </li>';
                                                    } else {
                                                        if ($v->getBelegt() == 0 && $v->getReihe() == $i) {
                                                            echo '
                                                        <li class="PremiumSitz">
                                                            <input type="checkbox" value="' . $v->getVorstellungsSitzplatzID() . '" id="' . $v->getVorstellungsSitzplatzID() . '">
                                                            <label for="' . $v->getVorstellungsSitzplatzID() . '"> <!-- ' . $v->getVorstellungsSitzplatzID() . '  --> </label>
                                                        </li>';
                                                        }
                                                    }
                                                }

                                                

                                            }
                                                ?>
                                        </ol>
                                        </li>
                                    <?php } ?>
                                </div>
                            </div>
                        <div class="col-12 center">
                            <!-- falls man eingeloggt ist, zum Buchungsprozess kommen -->
                            <?php if($_SESSION['loggedin'] == true) {
                                echo '<a class="btn btn-secondary btn-md btn-shadow margintop center" href="./?page=Warenkorb" id="buchung"role="button" onclick="getGebuchteSitze()">Zur Buchung</a>';
                            }else{

                               echo'
                             <a class="btn btn-secondary btn-md btn-shadow margintop" role="button">Erst anmelden, dann buchen</a>
                     
                                ';
                            } ?>

                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <script>
        $(document).ready(function() {


        });
        function getGebuchteSitze(){
            var gebuchteSitze = new Array();
            var Vorstellungsid = '<?php echo $_GET["Vorstellungs_id"] ?>';
            var checkBoxes = document.getElementsByTagName("input")
            for(var i = 0; i< checkBoxes.length;i++)
            {
                if(checkBoxes[i].type == 'checkbox' && checkBoxes[i].checked == true)
                {
                    gebuchteSitze.push(checkBoxes[i].value);
                }
            }
            var Sitze = JSON.stringify(gebuchteSitze);
            $.ajax({
                url: './components/Saalplanergebnis.php',
                type:'POST',
                dataType:'json',
                data: {
                        bookedSeats: Sitze,
                },
                success: function(data)
                {
                    window.location.assign(`./?page=Warenkorb&Vorstellungsid=${Vorstellungsid}&Sitze=${data}`);
                    return false;

                }
            });
        }


    </script>
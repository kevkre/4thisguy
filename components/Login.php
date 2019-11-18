
<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Benutzer.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/logout.php");
//Login,Registrierung,Kennwort ändern

if(isset($_GET['registration'])){

    $_SESSION["sitename"] = "Registrieren";

    function getcontent($page){
        global $aktuellesProgramm;
        $aktuellesProgramm->aktualisieren();
//  Erstellen der Login-Seite
        if( strcasecmp($page,"Login") == 0){
            echo '
            <div class="container">
            <div class="row">
            <div class="col-6 flycenter">
            <div class="card">
            <article class="card-body">
            <a href="./?page=Login" class="float-right btn btn-outline-primary">Zur Anmeldung</a>
            <h4 class="card-title mb-4 mt-1">Registrieren</h4>
            <form action="?page=Login&registration=true" method="post">
            <div class="form-group">
            <label>Nachname:</label>
            <input name="lastname" class="form-control" placeholder="Nachname" type="Text">
            </div>
            <div class="form-group">
            <label>Vorname:</label>
            <input name="firstname" class="form-control" placeholder="Vorname" type="Text">
            </div>
            <div class="form-group">
            <label>Geburtsdatum</label>
            <input name="birthdate" class="form-control" type="date"   id ="date">
            <div>
            </div>
            <div class="form-group">
            <label>Adresse:</label>
            <input name="street" class="form-control" placeholder="Straße" type="Text">
            <input name="housenumber" class="form-control" placeholder="Hausnummer" type="Text">
            <input name="postcode" id="postcode" class="form-control" onchange="getCity()" placeholder="PLZ" type="Text">
            <input name="city" id="city" class="form-control" onchange="getPostCode()" placeholder="Stadt" type="Text">
            </div>
            <div class="form-group">
            <label>E-Mail-Adresse:</label>
            <input name="email" class="form-control" placeholder="Email" type="email">
            </div>
            <div class="form-group">
            <label>Passwort:</label>
            <input name="password" type="password" class="form-control" placeholder="******">
            </div> 
            <div class="form-group">
            <label>Passwort wiederholen:</label>
            <input name="password1" type="password" class="form-control" placeholder="******">
            </div>
          
            ';

            echo'
                
            <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Registrieren</button>
            </div>                                                            
            </form>
            </article>
            </div>
            </div>

            </div>
            </div>
            
            <Script>   
               // Datepicker auf minimale und maximalen Wert setzen
            $(\'#date\').prop(\'max\',function(){
                date1 = new Date();
                date= new Date(date1.getFullYear()-18,date1.getMonth());
                return date.toJSON().split(\'T\')[0];
                })
              </Script>


                ';
                // Registrierunglogik nach dem Submit mit POST Variablen // Prüfung der Daten
                if(isset($_GET['registration']) && isset($_POST['lastname']) && isset($_POST['firstname']) && isset($_POST['street']) && isset($_POST['housenumber']) && isset($_POST['postcode']) && isset($_POST['city']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password1']) && !empty($_POST['lastname']) && !empty($_POST['firstname']) && !empty($_POST['street']) && !empty($_POST['housenumber']) && !empty($_POST['postcode']) && !empty($_POST['city']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['password1'])){
                    if ($_POST['password'] != $_POST['password1']){
                        echo '<script language="javascript">';
                        echo 'alert("Passwörter stimmen nicht überein")';
                        echo '</script>';

                    } else if(strlen($_POST['password']) <= 7){
                        echo '<script language="javascript">';
                        echo 'alert("Bitte wähle ein Passwort mit mindestens 8 Zeichen")';
                        echo '</script>';
                    } else
                    {
                        $benutzer = new Benutzer($_POST['password'],$_POST['firstname'],$_POST['lastname'],$_POST['birthdate'],$_POST['postcode'],$_POST['city'],$_POST['street'],$_POST['housenumber'],$_POST['email'],1,0,0);

                        if($benutzer->userExists($_POST['email']) == false) {
                            $benutzer->registrieren();

                        }
                    }
                }else{
                    echo '<script language="javascript">';
                    echo 'alert("Bitte zuerst das Formular ausfüllen")';
                    echo '</script>';
                }
            }}} elseif (isset($_GET['verify'])) {
//Account bestätigen - Seite
                $_SESSION["sitename"] = "Account bestätigen";

                function getcontent($page){
                    global $aktuellesProgramm;
                    $aktuellesProgramm->aktualisieren();
                    if( strcasecmp($page,"Login") == 0){
                        $email = (isset($_GET['email']) ? 'value="'.$_GET['email'].'"' : 'placeholder="mail@example.org"');
                        $key = (isset($_GET['key']) ? 'value="'.$_GET['key'].'"' : 'placeholder="your key"');
                        echo '
                     
                        <div class="container">
                        <div class="row">
                        <div class="col-6 flycenter">
                        <div class="card">
                        <article class="card-body">
                        <a href="./?page=Login" class="float-right btn btn-outline-primary">Anmelden</a>
                        <h4 class="card-title mb-4 mt-1">Account bestätigen</h4>
                        <form action="?page=Login&&verify=true" method="post">
                        <div class="form-group">
                        <label>E-Mail-Adresse:</label>
                        <input class="form-control" type="email" size="40" maxlength="250" name="email" '.$email.'>
                        </div>
                        <div class="form-group">
                        <label>Bestätigungskey:</label>
                        <input class="form-control" size="40"  maxlength="250" name="key" '.$key.'>
                        </div>
                      ';
                        echo'
                        <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block" value="Abschicken"> Account bestätigen  </button>
                        </div>                                                          
                        </form>
                        </article>
                        </div>
                        </div>

                        </div>
                        </div>     
                        ';
                        //Logik für Verifizierung
                        if($_GET['verify']==true && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['key']) && $_POST['key'] != ""){


                            $email = $_POST['email'];
                            $key = $_POST['key'];
                            Benutzer::verifyKey($email,$key);
                        }}
                    }
                } elseif (isset($_GET['reset'])) {
            // Passwort zurücksetzen - Seite
                    $_SESSION["sitename"] = "Passwort zurücksetzen";

                    function getcontent($page){
                        global $aktuellesProgramm;
                        $aktuellesProgramm->aktualisieren();
                        if( strcasecmp($page,"Login") == 0){
                            $email = (isset($_GET['email']) ? 'value="'.$_GET['email'].'"' : 'placeholder="mail@example.org"');
                            $key = (isset($_GET['key']) ? 'value="'.$_GET['key'].'"' : 'placeholder="your key"');
                            echo '
                            <div class="container">
                            <div class="row">
                            <div class="col-6 flycenter">
                            <div class="card">
                            <article class="card-body">
                            <a href="./?page=Login" class="float-right btn btn-outline-primary">Anmelden</a>
                            <h4 class="card-title mb-4 mt-1">Passwort ändern</h4>
                            <form action="?page=Login&&reset=true" method="post">
                            <div class="form-group">
                            <label>E-Mail-Adresse:</label>
                            <input class="form-control" type="email" size="40" maxlength="250" name="email" '.$email.'>
                            </div>
                            <div class="form-group">
                            <label>Bestätigungskey:</label>
                            <input class="form-control" size="40"  maxlength="250" name="key" '.$key.'>
                            </div>
                            <div class="form-group">
                            <label>Passwort:</label>
                            <input name="password" type="password" class="form-control" placeholder="******">
                            </div> 
                            <div class="form-group">
                            <label>Passwort wiederholen:</label>
                            <input name="password1" type="password" class="form-control" placeholder="******">
                            </div>
                            <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block" value="Abschicken"> Passwort ändern  </button>
                            </div>                                                          
                            </form>
                            </article>
                            </div>
                            </div>

                            </div>
                            </div>     
                            ';

                        //Logik für Passwort zurücksetzen
                            if(isset($_POST['email']) && isset($_POST['key']) && isset($_POST['password']) && isset($_POST['password1']) && !empty($_POST['email']) && !empty($_POST['key']) && !empty($_POST['password']) && !empty($_POST['password1'])){
                                if ($_POST['password'] != $_POST['password1']){
                                    echo '<script language="javascript">
                                    window.onload = function () {alert("Passwörter stimmen nicht überein")}  
                                  </script>';


                                }elseif(strlen($_POST['password']) <= 7){
                                    echo '<script language="javascript">
                                    window.onload = function(){alert("Bitte wähle ein Passwort mit mindestens 8 Zeichen")}';
                                    echo '</script>';
                                } else {
                                    $email = $_POST['email'];
                                    $key = $_POST['key'];
                                    $password = $_POST['password'];
                                    Benutzer::changePassword($email,$key, $password);
                                }}else{
                                echo '<script language="javascript">';
                                echo 'alert("Bitte
                              zuerst das Formular ausfüllen")';
                                echo '</script>';

                                }

                            }}} elseif(isset($_GET['password'])){
//Login Seite für den User
                                function getcontent($page){
                                    global $aktuellesProgramm;
                                    $aktuellesProgramm->aktualisieren();

                                    if( strcasecmp($page,"login") == 0){

                                        echo '
                                        <div class="container">
                                        <div class="row">
                                        <div class="col-6 flycenter">
                                        <div class="card">
                                        <article class="card-body">
                                        <a href="./?page=Login" class="float-right btn btn-outline-primary">Anmelden</a>
                                        <h4 class="card-title mb-4 mt-1">Passwort zurücksetzen</h4>
                                        <form action="?page=Login&&password=true" method="post" onsubmit="">
                                        <div class="form-group">
                                        <label>E-Mail-Adresse:</label>
                                        <input class="form-control" type="email" size="40" maxlength="250" name="email" placeholder="mail@example.org">
                                        </div>
                                        <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" value="Abschicken"> Passwort zurücksetzen  </button>
                                        </div>                                                          
                                        </form>
                                        </article>
                                        </div>
                                        </div>

                                        </div>
                                        </div>';    
// PHP Logik für Login
                                        if(isset($_GET['password']) && isset($_POST['email'])){
                                        Benutzer::passwordKey($_POST['email']);
                                    }

                                    }}

                                } else {

                                    $_SESSION["sitename"] = "Login";

                                    function getcontent($page){
                                        global $aktuellesProgramm;
                                        $aktuellesProgramm->aktualisieren();

                                        if( strcasecmp($page,"login") == 0){

                                            echo '
                                            <div class="container">
                                            <div class="row">
                                            <div class="col-6 flycenter">
                                            <div class="card">
                                            <article class="card-body">
                                            <a href="./?page=Login&&registration" class="float-right btn btn-outline-primary">Registrieren</a>
                                            <h4 class="card-title mb-4 mt-1">Anmelden</h4>
                                            <form action="?page=Login&login=true" method="post" onsubmit="">
                                            <div class="form-group">
                                            <label>E-Mail-Adresse:</label>
                                            <input class="form-control" type="email" size="40" maxlength="250" name="email" placeholder="mail@example.org">
                                            </div>
                                            <div class="form-group">
                                            <a class="float-right" href="./?page=Login&&password">Passwort vergessen/Passwort ändern?</a>
                                            <label>Password:</label>
                                            <input class="form-control" type="password" size="40"  maxlength="250" name="password" placeholder="password">
                                            </div>
                                            <div class="form-group"> 
                                            <div class="checkbox">
                                            <label> <input type="checkbox"> Passwort speichern </label>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <button type="submit"  class="btn btn-primary btn-block" value="Abschicken"> Anmelden  </button>
                                            </div>                                                          
                                            </form>
                                            </article>
                                            </div>
                                            </div>

                                            </div>
                                            </div>     
                                            ';

                                            if(isset($_GET['login']) && isset($_POST['email']) && $_POST['email'] != "" && isset($_POST['password']) && $_POST['password'] != ""){
                                                $eingeloggt = $aktuellesProgramm->anmelden($_POST['email'], $_POST['password']);

                                                if($eingeloggt != 0){
                                                    $benutzer = new Benutzer($eingeloggt[0], $eingeloggt[1], $eingeloggt[2], $eingeloggt[3], $eingeloggt[4], $eingeloggt[5], $eingeloggt[6], $eingeloggt[7], $eingeloggt[8], $eingeloggt[9], $eingeloggt[10], $eingeloggt[11]);
                                                }
                                            }

                                        }
                                    }}?>


<?php


class Benutzer
{
    private $Passwort;
    private $Vorname;
    private $Nachname;
    private $Geburtsdatum;
    private $Postleitzahl;
    private $Stadt;
    private $Strasse;
    private $Hausnummer;
    private $EMail;
    private $registration_key;
    private $loggedin;
    private $active;


    /**
     * Benutzer constructor.
     * @param $Passwort
     * @param $Vorname
     * @param $Nachname
     * @param $Geburtsdatum
     * @param $Postleitzahl
     * @param $Stadt
     * @param $Strasse
     * @param $Hausnummer
     * @param $EMail
     */
    public function __construct($Passwort, $Vorname, $Nachname, $Geburtsdatum, $Postleitzahl, $Stadt, $Strasse, $Hausnummer, $EMail, $registration_key, $loggedin, $active)
    {
        $this->Passwort = $Passwort;
        $this->Vorname = $Vorname;
        $this->Nachname = $Nachname;
        $this->Geburtsdatum = $Geburtsdatum;
        $this->Postleitzahl = $Postleitzahl;
        $this->Stadt = $Stadt;
        $this->Strasse = $Strasse;
        $this->Hausnummer = $Hausnummer;
        $this->EMail = $EMail;

        if($registration_key == 1){
            $this->registration_key = strval(rand(1000000000,9999999999));
        } else {
            $this->registration_key = $registration_key;
        }
        $this->loggedin = $loggedin;
        $this->active = $active;
    }

    //Getter und Setter
    /**
     * @return string
     */
    public function getRegistrationKey()
    {
        return $this->registration_key;
    }

    /**
     * @param string $registration_key
     */
    public function setRegistrationKey($registration_key)
    {
        $this->registration_key = $registration_key;
    }


    /**
     * @param mixed $EMail
     */
    public function setEMail($EMail): void
    {
        $this->EMail = $EMail;
    }

    /**
     * @return mixed
     */
    public function getEMail()
    {
        return $this->EMail;
    }

    /**
     * @return mixed
     */
    public function getPasswort()
    {
        return $this->Passwort;
    }

    /**
     * @param mixed $Passwort
     */
    public function setPasswort($Passwort): void
    {
        $this->Passwort = $Passwort;
    }

    /**
     * @return mixed
     */
    public function getVorname()
    {
        return $this->Vorname;
    }

    /**
     * @param mixed $Vorname
     */
    public function setVorname($Vorname): void
    {
        $this->Vorname = $Vorname;
    }

    /**
     * @return mixed
     */
    public function getNachname()
    {
        return $this->Nachname;
    }

    /**
     * @param mixed $Nachname
     */
    public function setNachname($Nachname): void
    {
        $this->Nachname = $Nachname;
    }

    /**
     * @return mixed
     */
    public function getGeburtsdatum()
    {
        return $this->Geburtsdatum;
    }

    /**
     * @param mixed $Geburtsdatum
     */
    public function setGeburtsdatum($Geburtsdatum): void
    {
        $this->Geburtsdatum = $Geburtsdatum;
    }

    /**
     * @return mixed
     */
    public function getPostleitzahl()
    {
        return $this->Postleitzahl;
    }

    /**
     * @param mixed $Postleitzahl
     */
    public function setPostleitzahl($Postleitzahl): void
    {
        $this->Postleitzahl = $Postleitzahl;
    }

    /**
     * @return mixed
     */
    public function getStadt()
    {
        return $this->Stadt;
    }

    /**
     * @param mixed $Stadt
     */
    public function setStadt($Stadt): void
    {
        $this->Stadt = $Stadt;
    }

    /**
     * @return mixed
     */
    public function getStrasse()
    {
        return $this->Strasse;
    }

    /**
     * @param mixed $Strasse
     */
    public function setStrasse($Strasse): void
    {
        $this->Strasse = $Strasse;
    }

    /**
     * @return mixed
     */
    public function getHausnummer()
    {
        return $this->Hausnummer;
    }

    /**
     * @param mixed $Hausnummer
     */
    public function setHausnummer($Hausnummer): void
    {
        $this->Hausnummer = $Hausnummer;
    }

    function userExists($email){

        global $connection;
        $statement = $connection->prepare("SELECT * FROM account WHERE e_mail = '{$email}';");
        $statement->execute(array('e_mail' => $email));
        $varExist =  !!$statement->fetch(PDO::FETCH_ASSOC);

        return $this->userExistsLogik($varExist); //returns true if userExists, else false

    }

    public function userExistsLogik($varExist){

        if(!empty($varExist)){
            //user already exists
            echo "Diese E-Mail wird bereits verwendet!";
            return true;
        }
        return false;

    }

    public function registrieren()
    {
        try {
            global $connection;
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $password = md5($this->getPasswort());
            $statement = $connection->prepare("INSERT INTO account (nachname, vorname, strasse, hausnummer, standortid, e_mail, passwort, active, registration_key, geburtsdatum)
                            VALUES ('{$this->getNachname()}', '{$this->getVorname()}','{$this->getStrasse()}', '{$this->getHausnummer()}',(SELECT standort_id FROM standort WHERE plz = '{$this->getPostleitzahl()}' AND stadt = '{$this->getStadt()}'), '{$this->getEMail()}', '{$password}', 0,'{$this->getRegistrationKey()}','{$this->getGeburtsdatum()}')");
            $statement->execute();

            $string = $this->registrierenAusgabe();

            echo mail($string["email"], $string["subject"], $string["text"], $string["from"]); //mail, isn't working at the moment (therefore echo)
            
        } catch(PDOException $err){
            //echo $err;
            echo "Datenbankfehler, bitte wenden Sie sich an den Administrator des Systems oder versuchen Sie es später noch einmal.";
        }

    }

    public function registrierenAusgabe(){

        $subject = "Ihre Registrierung auf ". DOMAIN; //subject of email
        $from = "From: " . SITENAME . " <".EMAILDESKINOS.">\r\n"; //sender of email
        $from .= "Content-Type: text/html\r\n";
        $text = 'Hier kommt der Text rein. Bitte folgen sie diesem Link: <a href="https://' . DOMAIN . '/?page=Login&&verify=true&&key='.$this->registration_key.'&&email='.$this->getEMail().'"> https://' . DOMAIN . '/?page=Login&&verify=true&&key='.$this->getRegistrationKey().'&&email='.$this->getEMail().'</a>'; //tect of mail

        //js message
        echo '<script language="javascript">';
        echo 'window.onload = function(){alert("user angelegt, Sie erhalten nun eine Registrierungsmail mit einem entsprechenden Registrierungslink. \n "'.$text.')}';
        echo '</script>';
        
        //nur zum testen!
       // echo $text;
        //echo mail($this->getEMail(), $subject, $text, $from);

        //make array
        $string["email"] = $this->getEMail();
        $string["subject"] = $subject;
        $string["text"] = $text;
        $string["from"] = $from;

        return $string; //return array with information

    }

    public static function verifyKey($email,$registration_key)
    {
        global $connection;
        $statement = $connection->prepare("SELECT user_id, registration_key FROM account WHERE e_mail = '".$email."' LIMIT 1");
        $result = $statement->execute(array('e_mail' => $email));
        $user = $statement->fetch();

        //Check Registration Key. If False: Not verified.
        if ($user !== false && $registration_key == $user['registration_key']) {

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $connection->prepare("UPDATE account SET registration_key = '0', active = 1 WHERE user_id = ?");
            $statement->execute(array($user['user_id']));

        } else {
            echo '<script>
                        window.alert( "Der Registrierungscode war ungültig.");
                   </script>';
        }
    }

    public static function changePassword($email,$changekey, $password)
    {
        echo "funktion wird aufgerufen";
        global $connection;
        $statement = $connection->prepare("SELECT user_id, registration_key, active FROM account WHERE e_mail = '{$email}' LIMIT 1");
        $result = $statement->execute(array('e_mail' => $email));
        $user = $statement->fetch();

        //Check Registration Key. If False: Not verified.
        if ($user !== false && $changekey == $user['registration_key'] && $user['active'] == 1) {

            $password = md5($password);

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $connection->prepare("UPDATE account SET registration_key = '0', passwort = '{$password}' WHERE user_id = ?");
            $statement->execute(array($user['user_id']));

                        echo '<script>
                        window.alert( "Das Passwort wurde erfolgreich aktualisiert.");
                   </script>';

        } else {
            echo '<script>
                        window.alert( "Der Passwortcode war ungültig.");
                   </script>';
        }
    }

    public static function passwordKey($email){

        $registration_key = strval(rand(1000000000,9999999999));

        global $connection;
        $statement = $connection->prepare("SELECT user_id, active FROM account WHERE e_mail ='{$email}' LIMIT 1");
        $result = $statement->execute(array('e_mail' => $email));
        $user = $statement->fetch();

        //Check Registration Key. If False: Not verified.
        if ($user['active'] == 1) {

            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $statement = $connection->prepare("UPDATE account SET registration_key = '{$registration_key}' WHERE user_id = ?");
            $statement->execute(array($user['user_id']));

            $string = (new Benutzer("", "", "", "", "", "", "", "", "", 0, "", ""))->passwordKeyAusgabe($registration_key, $email);

            //nur zum testen!
            echo mail($email, $string["subject"], $string["text"], $string["from"]);
            //echo $text;

        } else {

            echo '<script>
                        window.alert( "Zu diesem User kann kein Passwort zurückgesetzt werden.");
                   </script>';

        }
    }

    public function passwordKeyAusgabe($registration_key, $email){

        $subject = "Ihr Passwort wurde zurückgesetzt ". DOMAIN;
        $from = "From: " . SITENAME . " <".EMAILDESKINOS.">\r\n";
        $from .= "Content-Type: text/html\r\n";
        $text = 'Hier kommt der Text rein. Bitte folgen sie diesem Link: <a href="https://' . DOMAIN . '/?page=Login&&reset=true&&key='.$registration_key.'&&email='.$email.'"> https://' . DOMAIN . '/?page=Login&&reset=true&&key='.$registration_key.'&&email='.$email.'</a>';

        //nur zum testen!
        //echo mail($email, $subject, $text, $from);
        echo $text;

        $string["subject"] = $subject;
        $string["text"] = $text;
        $string["from"] = $from;

        return $string;
        

    }

}
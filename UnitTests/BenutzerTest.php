<?php

use PHPUnit\Framework\TestCase;

class BenutzerTest extends TestCase
{

    private $benutzer;

    public function setUp(): void
    {

        //include_once("./components/Klassen/Benutzer.php");
        $this->benutzer = new Benutzer("Passwort", "Vorname", "Nachname", "Geburtsdatum", "PLZ", "Stadt", "Strasse", "Hausnummer", "EMail", 0, TRUE, TRUE);

    }

    /**@test */
    public function test_get_registrations_key()
    {

        $key = $this->benutzer->getRegistrationKey();
        $this->assertEquals(0, $key);

    }

    /**@test */
    public function test_set_registrations_key()
    {

        $this->benutzer->setRegistrationKey(25);
        $this->assertEquals(25, $this->benutzer->getRegistrationKey());

    }

    /**@test */
    public function test_registrations_key_equals_one()
    {

        $this->benutzer = new Benutzer("Passwort", "Vorname", "Nachname", "Geburtsdatum", "PLZ", "Stadt", "Strasse", "Hausnummer", "EMail", 1, true, true);
        $this->assertTrue(1 != $this->benutzer->getRegistrationKey());

    }

    /**@test */
    public function test_get_email()
    {

        $email = $this->benutzer->getEMail();
        $this->assertEquals("EMail", $email);

    }

    /**@test */
    public function test_set_email()
    {

        $this->benutzer->setEMail("new");
        $this->assertEquals("new", $this->benutzer->getEMail());

    }

    /**@test */
    public function test_get_Passwort()
    {

        $Passwort = $this->benutzer->getPasswort();
        $this->assertEquals("Passwort", $Passwort);

    }

    /**@test */
    public function test_set_Passwort()
    {

        $this->benutzer->setPasswort("new");
        $this->assertEquals("new", $this->benutzer->getPasswort());

    }

    /**@test */
    public function test_get_Vorname()
    {

        $Vorname = $this->benutzer->getVorname();
        $this->assertEquals("Vorname", $Vorname);

    }

    /**@test */
    public function test_set_Vorname()
    {

        $this->benutzer->setVorname("new");
        $this->assertEquals("new", $this->benutzer->getVorname());

    }

    /**@test */
    public function test_get_Nachname()
    {

        $Nachname = $this->benutzer->getNachname();
        $this->assertEquals("Nachname", $Nachname);

    }

    /**@test */
    public function test_set_Nachname()
    {

        $this->benutzer->setNachname("new");
        $this->assertEquals("new", $this->benutzer->getNachname());

    }

    /**@test */
    public function test_get_Geburtsdatum()
    {

        $Geburtsdatum = $this->benutzer->getGeburtsdatum();
        $this->assertEquals("Geburtsdatum", $Geburtsdatum);

    }

    /**@test */
    public function test_set_Geburtsdatum()
    {

        $this->benutzer->setGeburtsdatum("new");
        $this->assertEquals("new", $this->benutzer->getGeburtsdatum());

    }

    /**@test */
    public function test_get_Postleitzahl()
    {

        $Postleitzahl = $this->benutzer->getPostleitzahl();
        $this->assertEquals("PLZ", $Postleitzahl);

    }

    /**@test */
    public function test_set_Postleitzahl()
    {

        $this->benutzer->setPostleitzahl("new");
        $this->assertEquals("new", $this->benutzer->getPostleitzahl());

    }

    /**@test */
    public function test_get_Stadt()
    {

        $Stadt = $this->benutzer->getStadt();
        $this->assertEquals("Stadt", $Stadt);

    }

    /**@test */
    public function test_set_Stadt()
    {

        $this->benutzer->setStadt("new");
        $this->assertEquals("new", $this->benutzer->getStadt());

    }

    /**@test */
    public function test_get_Strasse()
    {

        $Strasse = $this->benutzer->getStrasse();
        $this->assertEquals("Strasse", $Strasse);

    }

    /**@test */
    public function test_set_Strasse()
    {

        $this->benutzer->setStrasse("new");
        $this->assertEquals("new", $this->benutzer->getStrasse());

    }

    /**@test */
    public function test_get_Hausnummer()
    {

        $Hausnummer = $this->benutzer->getHausnummer();
        $this->assertEquals("Hausnummer", $Hausnummer);

    }

    /**@test */
    public function test_set_Hausnummer()
    {

        $this->benutzer->setHausnummer("new");
        $this->assertEquals("new", $this->benutzer->getHausnummer());

    }

    /**@test */
    public function test_user_dosnt_exists_Logik()
    {

        $user = array();

        $this->assertFalse($this->benutzer->userexistsLogik($user));

    }

    /**@test */
    public function test_user_exists_Logik()
    {

        $user = array($this->benutzer);

        $this->assertTrue($this->benutzer->userexistsLogik($user));

    }

    /**@test */
    public function test_registrieren_Ausgabe()
    {

        include_once("./config/main_config.php");

        $expected = array(  "email" => $this->benutzer->getEMail(),
                            "subject" => "Ihre Registrierung auf fly-cinema.de",
                            "text" => 'Hier kommt der Text rein. Bitte folgen sie diesem Link: <a href="https://fly-cinema.de/?page=Login&&verify=true&&key=0&&email=EMail"> https://fly-cinema.de/?page=Login&&verify=true&&key=0&&email=EMail</a>',
                            "from" => "From: FlyCinema - Himmlische Unterhaltung <mail@fly-cinema.de>\r\nContent-Type: text/html\r\n"
                        );
                            

        $this->assertEquals($expected, $this->benutzer->registrierenAusgabe());

    }

    /**@test */
    public function test_password_key_Ausgabe()
    {

        include_once("./config/main_config.php");

        $expected = array(  "subject" => "Ihr Passwort wurde zurückgesetzt fly-cinema.de",
                            "text" => 'Hier kommt der Text rein. Bitte folgen sie diesem Link: <a href="https://fly-cinema.de/?page=Login&&reset=true&&key=0&&email=EMail"> https://fly-cinema.de/?page=Login&&reset=true&&key=0&&email=EMail</a>',
                            "from" => "From: FlyCinema - Himmlische Unterhaltung <mail@fly-cinema.de>\r\nContent-Type: text/html\r\n"
                        );
                            

        $this->assertEquals($expected, $this->benutzer->passwordKeyAusgabe(0, "EMail"));

    }
}
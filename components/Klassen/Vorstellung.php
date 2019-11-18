<?php



class Vorstellung
{
    private $vorstellungsID;
    private $vorstellungsLaenge;
    private $datum;
    private $dreiDimensional;
    private $uhrzeit;
    private $beschreibung;
    private $grundpreis;
    private $filmID;
    private $kinosaalID;
    private $vorstellungsSitzplaetze = array();
    private $connection;
    private $dimension;


    /**
     * Vorstellung constructor.
     * @param $vorstellungsID
     * @param $vorstellungsLaenge
     * @param $datum
     * @param $dreiDimensional
     * @param $uhrzeit
     * @param $beschreibung
     * @param $grundpreis
     * @param $filmID
     * @param $kinosaalID
     */
    public function __construct($vorstellungsID, $vorstellungsLaenge, $datum, $dreiDimensional, $uhrzeit, $beschreibung, $grundpreis, $filmID, $kinosaalID,$vorstellungsSitzplaetze)
    {
        $this->vorstellungsID = $vorstellungsID;
        $this->vorstellungsLaenge = $vorstellungsLaenge;
        $this->datum = $datum;
        $this->dreiDimensional = $dreiDimensional;
        $this->uhrzeit = $uhrzeit;
        $this->beschreibung = $beschreibung;
        $this->grundpreis = $grundpreis;
        $this->filmID = $filmID;
        $this->kinosaalID = $kinosaalID;
        $this->vorstellungsSitzplaetze = $vorstellungsSitzplaetze;
        if($this->dreiDimensional==true){
            $this->dimension = '3D';
        }
        else {
            $this->dimension = '2D';
        }
    }

    /**
     * @return mixed
     */

    public function getDimension(){
        return $this->dimension;
    }

    public function getVorstellungsID()
    {
        return $this->vorstellungsID;
    }

    /**
     * @return mixed
     */
    public function getVorstellungsLaenge()
    {
        return $this->vorstellungsLaenge;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @return mixed
     */
    public function getDreiDimensional()
    {
        return $this->dreiDimensional;
    }

    /**
     * @return mixed
     */
    public function getUhrzeit()
    {
        return $this->uhrzeit;
    }

    /**
     * @return mixed
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

    /**
     * @return mixed
     */
    public function getGrundpreis()
    {
        return $this->grundpreis;
    }

    /**
     * @return mixed
     */
    public function getFilmID()
    {
        return $this->filmID;
    }

    /**
     * @return mixed
     */
    public function getKinosaalID()
    {
        return $this->kinosaalID;
    }



    public function getVorstellungsSitzplaetze()
    {

        return  $this->vorstellungsSitzplaetze;
    }
    public function setzeSitzPlaetzeBelegt($VorstellungssitzplatzIds)
    {
        foreach($VorstellungssitzplatzIds as $v)
        {
            $v->setBelegt();
        }
    }

   /* public function erstelleSaalPlan()
    {
        echo '<div class="container">
        <div class="row">
            <div class="col-12 col-centered">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="col-4">
                                <div class="card">
                                    <div class="Saal">

         <?php $anzahlReihen = 0;
        foreach($this->vorstellungsSitzplaetze as $v) {
            if (($v->getReihe()) > $anzahlReihen) {
                $anzahlReihen = $v->getReihe();
            }
        } 

        for ($i = 1; $i < $anzahlReihen + 1; $i++) {
            <li class="row row--' . $i . '"> ';
        foreach ($this->vorstellungsSitzplaetze as $v) {
            if ($v->getReihe() == $i) {

                <
                ol class="Sitze" type = "' .$i. '" >
                                                <li class="Sitz" >
                                                  <input type = "checkbox"
                    if ($v->getBelegt() == 1) {
                        echo 'disabled';
                    }
                    echo 'id="' . $v->getVorstellungsSitzplatzID() . '" />
                                                  <label for="' . $v->getVorstellungsSitzplatzID() . '"></label>
                                            </ol>
                                        
                }
            }
            
                        </li>

                                </div>
                                </div>
                            </div>
                            <div class="col-4">
                                    <a href="./?page=Warenkorb&Warenkorb_id" class="btn btn-secondary btn-md btn-shadow margintop" role="button">Zur Buchung</a>  
                            </div>
    
                        </div>
                    </div>
                </div>
            </div>
        </div> ';

                    }
        }
    }*/

    /*  echo'
                                  <li class="row row--1">
                                      <ol class="Sitze" type="A">
                                          <li class="Sitz">
                                              <input type="checkbox" id="1A" />
                                              <label for="1A">1A</label>

                                      </ol>
                                  </li>
                                  <li class="row row--2">
                                      <ol class="Sitze" type="A">
                                          <li class="Sitz">
                                              <input type="checkbox" id="2A" />
                                              <label for="2A">2A</label>
                                          </li>

                                          </li>
                                      </ol>
                                  </li>
                                  <li class="row row--3">
                                      <ol class="Sitze" type="A">
                                          <li class="Sitz">
                                              <input type="checkbox" id="3A" />
                                              <label for="3A">3A</label>
                                          </li>
                                      </ol>
                                  </li>
                                  <li class="row row--4">
                                      <ol class="Sitze" type="A">
                                          <li class="Sitz">
                                              <input type="checkbox" id="4A" />
                                              <label for="4A">4A</label>
                                          </li>
                                      </ol>
                                  </li>
                                  <li class="row row--5">
                                      <ol class="Sitze" type="A">
                                          <li class="Sitz">
                                              <input type="checkbox" id="5A" />
                                              <label for="5A">5A</label>
                                          </li>
                                      </ol>
                                  </li>
                              </div>
                          </div>
                      </div>
                      <div class="col-4">
                              <a href="./?page=Warenkorb&Warenkorb_id" class="btn btn-secondary btn-md btn-shadow margintop" role="button">Zur Buchung</a>
                      </div>

                  </div>
              </div>
          </div>
      </div>
  </div>';

}

}
*/
}
?>
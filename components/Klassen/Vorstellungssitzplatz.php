<?php
class Vorstellungssitzplatz{
    private $reihe;
    private $vorstellungsSitzplatzID;
    private $belegt;
    private $premium;

    /**
     * @return mixed
     */
    public function getReihe()
    {
        return $this->reihe;
    }

    /**
     * @param mixed $reihe
     */
    public function setReihe($reihe)
    {
        $this->reihe = $reihe;
    }

    public function __construct($vorstellungsSitzplatzID,$belegt,$reihe, $premium)
    {
        $this->reihe = $reihe;
        $this->vorstellungsSitzplatzID = $vorstellungsSitzplatzID;
        $this ->belegt = $belegt;
        $this->premium = $premium;	
    }

    public function getVorstellungsSitzplatzID(){
        return $this->vorstellungsSitzplatzID;
    }
    
    public function getBelegt(){
        return $this->belegt;
    }

    public function setBelegt()
    {
        global $connection;
        $statement = $connection->prepare("Update vorstellungssitzplatz SET belegt = 1 WHERE vorstellungssitzplatz.vorstellungssitzplatz_id = $this->vorstellungsSitzplatzID ");
        $statement->execute();
        $sitzplaetze = $statement->fetchAll();

    }



        /**
         * Get the value of premium
         */ 
        public function getPremium()
        {
                return $this->premium;
        }

        /**
         * Set the value of premium
         *
         * @return  self
         */ 
        public function setPremium($premium)
        {
                $this->premium = $premium;

                return $this;
        }
}

?>
<?php


class Zusatzangebot
{

    private $zusatzangeboteID;
    private $uuid;
    private $preis;
    private $titel;
    private $beschreibung;

    /**
     * Zusatzangebot constructor.
     * @param $zusatzangeboteID
     * @param $uuid
     * @param $preis
     * @param $titel
     * @param $beschreibung
     */
    public function __construct($zusatzangeboteID, $uuid, $preis, $titel, $beschreibung)
    {
        $this->zusatzangeboteID = $zusatzangeboteID;
        $this->uuid = $uuid;
        $this->preis = $preis;
        $this->titel = $titel;
        $this->beschreibung = $beschreibung;
    }

    /**
     * @return mixed
     */
    public function getZusatzangeboteID()
    {
        return $this->zusatzangeboteID;
    }

    /**
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * @return mixed
     */
    public function getPreis()
    {
        return $this->preis;
    }

    /**
     * @return mixed
     */
    public function getTitel()
    {
        return $this->titel;
    }

    /**
     * @return mixed
     */
    public function getBeschreibung()
    {
        return $this->beschreibung;
    }

}
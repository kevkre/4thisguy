<?php

include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Programm.php");

$standort = (isset($_POST["standort"])) ? $_POST["standort"] : "";
$movie = (isset($_POST["movie"])) ? $_POST["movie"] : "";
$genre = (isset($_POST["genre"])) ? $_POST["genre"] : "";
$date = (isset($_POST["date"])) ? $_POST["date"] : "";


global $aktuellesProgramm;
$array = array("titel"=>$movie, "genre.bezeichnung"=>$genre,"stadt" =>$standort,"datum" =>$date);
$aktuellesProgramm->sucheVorstellungen($array);

?>
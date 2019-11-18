<?php
/**
 * Created by IntelliJ IDEA.
 * User: KREMPELS
 * Date: 28.10.2019
 * Time: 11:23
 */

//Einbindung von Files um dynamisches zu erzeugen
if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php")){
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php");
}else{
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/connect_db.php");

}
//Ajax-aufruf entgegennehmen und verarbeiten
global $connection;
$city = (isset($_POST["parameter"])) ? $_POST["parameter"] : "";

try{
    $statement =  $connection->prepare("SELECT DISTINCT plz FROM standort WHERE stadt = '{$city}';");
    $statement->execute();
    $plz = $statement->fetchAll();
    // zurücksenden der Daten an den Client
    if(!empty($plz)) {
        echo json_encode($plz[0]["plz"], JSON_UNESCAPED_UNICODE);
    }else{echo json_encode(null);}


}catch(PDOException $e) {
    print $e->getMessage();
    die();
}
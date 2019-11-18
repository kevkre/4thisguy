<?php

//Einbindung von Files um dynamisches zu erzeugen
if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php")){
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php");
}else{
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config.php");
    include_once($_SERVER['DOCUMENT_ROOT'] . "/config/connect_db.php");

}
//Ajax-aufruf entgegennehmen und verarbeiten
global $connection;
$plz = (isset($_POST["parameter"])) ? $_POST["parameter"] : "";
try{
      $statement =  $connection->prepare("SELECT DISTINCT stadt FROM standort WHERE plz = {$plz}");
      $statement->execute();
      $stadt = $statement->fetchAll();

      // zurücksenden der Daten an Client
      if(!empty($stadt)) {
          echo json_encode($stadt[0]["stadt"], JSON_UNESCAPED_UNICODE);
      }else{echo json_encode("");}


}catch(PDOException $e) {
    print $e->getMessage();
    die();
}
/**
 * Created by IntelliJ IDEA.
 * User: KREMPELS
 * Date: 28.10.2019
 * Time: 11:22
 */
?>
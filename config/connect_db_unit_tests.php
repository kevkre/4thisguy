<?php

global $connection;

function connect($connection){

    if ($connection == null){

        include_once("./config/main_config.php");
        
        try{
            $connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE,
                        USERNAME,
                        PASSWORD,
                        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        }catch(PDOException $e){
            print $e->getMessage();
            die();
        }
    }

    return $connection;

}

function get_connection($old_connection){

	$connection = connect($old_connection);

    return $connection;

}

?>
<?php
	try{
	$connection = new PDO('mysql:host='.HOST.';dbname='.DATABASE,
					USERNAME,
					PASSWORD,
		array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}catch(PDOException $e){
    print $e->getMessage();
    die();
}
?>


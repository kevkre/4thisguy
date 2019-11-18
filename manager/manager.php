<?php

//Wird nun in index.php getan.
/*
//Weitere Config File liegt auf dem Server, bitte bei Änderungen an der Config direkt an @jonaswolf wenden, damit ich sie auf dem Server anpassen kann.
if(file_exists("config/main_config_1.php")){
	include_once("config/main_config_1.php");
}else{
	include_once("config/main_config.php");
}

//Manager Der ?page= Variable Verwaltet
include_once("config/connect_db.php");
*/

//Wird nun durch Site.php übernommen.
/*function importpage($page){
	if (!file_exists("./components/".$page.".php")) $page = "404";
	include_once("./components/".$page.".php");
	return $page;
}

function sitename($sitename){
	return $sitename;
}

function gettitle($sitename){
	$title = SITENAME . " | " . sitename($sitename);
	return $title;
}*/

?>
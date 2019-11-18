<?php
// Error Site wenn getcontent() keine Seite findet
$_SESSION["sitename"] = "Error 404";

function getcontent($page){

    if( strcasecmp($page,"404") == 0){
    echo '
<h1>Error 404</h1>
<h2>Die von Ihnen angeforderte Seite wurde nicht gefunden</h2>';
}}?>
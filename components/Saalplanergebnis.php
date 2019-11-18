<?php
/**
 * Created by IntelliJ IDEA.
 * User: KREMPELS
 * Date: 18.10.2019
 * Time: 17:48
 */
// Gebuchte Sitze an PHP-Server Side senden
$gebuchteSitze = (isset($_POST["bookedSeats"])) ? $_POST["bookedSeats"] : "";
echo json_encode($gebuchteSitze);
?>
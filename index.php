<?php
//Require Block, hier alle WICHTIGEN Dateien einbinden und Wichtiges setzen.


SESSION_START();

// timeout
ini_set('session.gc_maxlifetime',600);
ini_set('session.cookie_lifetime',600);
$anfragenZeit = $_SERVER['REQUEST_TIME'];
$timeout_Dauer = 600;
if(isset($_SESSION['LAST_ACTIVITY']) && ($anfragenZeit - $_SESSION['LAST_ACTIVITY'] > $timeout_Dauer))
{
	session_unset();
	session_destroy();
	session_start();
}
$_SESSION['LAST_ACTIVITY'] = $anfragenZeit;
//Weitere Config File liegt auf dem Server, bitte bei Änderungen an der Config direkt an @jonaswolf wenden, damit ich sie auf dem Server anpassen kann.
if(file_exists($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php")){
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config_1.php");
}else{
	include_once($_SERVER['DOCUMENT_ROOT'] . "/config/main_config.php");
}
include_once("config/connect_db.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Site.php");
include_once($_SERVER['DOCUMENT_ROOT'] . "/components/Klassen/Programm.php");
$aktuellesProgramm = new Programm($connection);
$aktuellesProgramm->gibAlleVorstellungen();
header('Content-Type: text/html; charset=UTF-8');

error_reporting(E_ALL); //Errorreporting. Muss im Produktivbetrieb deaktiviert werden.

if (!isset($_GET["page"])) {
	$Seite = new Site("Start");
} else {
	$Seite = new Site($_GET["page"]);
}
if(!isset($_SESSION['loggedin']))
{
	$_SESSION['loggedin'] = false;
}


$Sitze = json_decode($_SESSION["Sitze"]);
?>
<!DOCTYPE html>
<html lang="de">

<head>
	<link rel="stylesheet" href="public/css/style.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="icon" type="image/png" href="/img/favicon.png">
	<title><?php echo $Seite->gettitle(); ?></title>	
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
	<wrapper style="height:100%">
		<header>
			<?php include_once($_SERVER['DOCUMENT_ROOT'] .  "/components/NaviLeiste.php"); ?>
		</header>
		<main class="FooterSpace">
			<?php
			getcontent($Seite->getpage());
			?>
		</main >
		<footer>
			<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/components/FussLeiste.php"); ?>
		</footer>
	</wrapper>
</body>

</html>

<script>
	$('#logout').click(function(){
		$.ajax({
			url: './components/logout.php',
			type:'POST',
			dataType:'json',
			data: {
				parameter: false,
			},
			success:function(data){
				window.alert("success"+data);
			}

		});
	});
    function getCity(){
        var postcode = document.getElementById("postcode").value;
        $.ajax({
            url: './components/loginajax/postleitzahl.php',
            type:'POST',
            dataType:'json',
            data: {
                parameter: postcode,
            },
            success:function(data){

                var city = data;
                if(city === ""){
                    document.getElementById("city").value= "";
                    $('#city').prop('placeholder','Stadt');
                } else{
                    document.getElementById("city").value= city;
                }
            }

        });

    }

    function getPostCode() {
        var city = document.getElementById("city").value;
        $.ajax({
            url: './components/loginajax/stadt.php',
            type: 'POST',
            dataType: 'json',
            data: {
                parameter: city,
            },
            success: function (data) {
                var plz = data;
                if (plz === null) {
                    document.getElementById("postcode").value = "";
                    $('#postcode').prop('placeholder', 'PLZ');
                } else {
                    document.getElementById("postcode").value = plz;
                }
            }

        });
    }

</script>


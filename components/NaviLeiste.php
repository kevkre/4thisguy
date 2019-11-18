<!-- PHP für Navigationsleiste -->
<div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="./?page=Start"><img src="./components/logo_ohneText.png" width="54" height="32" class="d-inline-block align-top" alt="Logo">
    FlyCinema</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor02" aria-controls="navbarColor02" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarColor02">
    <ul class="navbar-nav mr-auto">
      <?php if($Seite->getpage() == "Suche"){echo '<li class="nav-item active">';}else{'<li class="nav-item">';}?> 
        <a class="nav-link" href="./?page=Suche">Vorstellung finden <span class="sr-only">(current)</span></a>
      </li>
      <?php if($Seite->getpage() == "Angebote"){echo '<li class="nav-item active">';}else{'<li class="nav-item">';}?>
        <a class="nav-link" href="./?page=Angebote">Angebote</a>
      </li>
      <?php if($Seite->getpage() == "Standorte"){echo '<li class="nav-item active">';}else{'<li class="nav-item">';}?>
        <a class="nav-link" href="./?page=Standorte">Standorte</a>
      </li>
      <?php if($Seite->getpage() == "Filme"){echo '<li class="nav-item active">';}else{'<li class="nav-item">';}?>
        <a class="nav-link" href="./?page=Filme">Filme</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0">
        <!-- Anzeige ob Eingeloggt wurde oder nicht -->
        <?php
          if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == TRUE){
            
              echo '<div id="usernamebox">'.'Hallo '.$_SESSION["vorname"].'</div>';
              echo '<a class="btn btn-outline-primary" id = "logout" href="./?page=Login"  role="button">Abmelden</a>';

          } else {
              global $aktuellesProgramm;
              $aktuellesProgramm->setIsloggedin(false);
              echo '<a class="btn btn-outline-primary" href="./?page=Login" role="button">Anmeldung</a>';
          }

        ?>
    </form>
  </div>
</nav>
</div>


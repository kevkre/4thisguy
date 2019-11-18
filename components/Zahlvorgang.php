<?php

$_SESSION["sitename"] = "Zahlvorgang";

function getcontent($page)
{
    // statische Zahlungsseite ohne Implementierung
    global $aktuellesProgramm,$Sitze;
    $aktuellesProgramm->aktualisieren();

        echo '<div class="container">
        <div class="row">
            <div class="col-12 col-centered">
                <div class="card">
                    <div class="container">
                        <div class="row">
                            <div class="card-content col-12">
                                <div class="BestellText">
                                <h2 class=margintop> Jetzt Zahlen - Sofort Schauen! </h2>
                                </div>
                            </div>
                        </div>

                        <div class="row smallrow">
                            
                            <div class="col-5 col-centered">
                            <h3> Hier kannst du Geld sparen</h3> <span class="oi oi-arrow-right"></span>
                            </div>
                            <form class="col-3 col-centered">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Rabattcode oder Gutschein">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-secondary">Einlösen</button>
                                    </div>
                                </div>
                            </form>

                            <div class="col-12 col-centered">
                            <div class="custom-control custom-radio">
                              <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked="" required="">
                              <label class="custom-control-label" for="credit">Kreditkarte</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required="">
                              <label class="custom-control-label" for="debit">PayPal</label>
                            </div>
                            <div class="custom-control custom-radio">
                              <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required="">
                              <label class="custom-control-label" for="paypal">Im Kino</label>
                            </div>
                          </div>
                        </div>

                        <div class="row smallrow">
              <div class="col-4 col-centered">
                <label for="cc-name">Name on card</label>
                <input type="text" class="form-control" id="cc-name" placeholder="" required="">
                <small class="text-muted">Vorname, Name wie auf Karte</small>
                <div class="invalid-feedback">
                  Name des Kartenbesitzers ist erforderlich
                </div>
              </div>
              <div class="col-4 col-centered">
                <label for="cc-number">Kreditkartennummer</label>
                <input type="text" class="form-control" id="cc-number" placeholder="" required="">
                <div class="invalid-feedback">
                  Kreditkartenummer ist erforderlich
                </div>
              </div>
            </div>


            <div class="row smallrow">
              <div class="col-2 col-centered">
                <label for="cc-expiration">Gültigkeit</label>
                <input type="text" class="form-control" id="cc-expiration" placeholder="" required="">
                <div class="invalid-feedback">
                Gültigkeitsdatum benötigt
                </div>
              </div>
              <div class="col-2 col-centered">
                <label for="cc-expiration">Sicherheitscode</label>
                <input type="text" class="form-control" id="cc-cvv" placeholder="" required="">
                <div class="invalid-feedback">
                  Sicherheitscode benötigt
                </div>
              </div>
            </div>


                        <div class="row">
                            <div class="card-content col-12">
                                <div class=ButtonRahmen>
                                    <div class="ButtonMitte">
                                    <a class="btn btn-secondary btn-md btn-shadow margintop center" href="./?page=Bestellbestätigung" id="buchung"role="button" onclick="getGebuchteSitze()">Jetzt Kaufen</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

?>
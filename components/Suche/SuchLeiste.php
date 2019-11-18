<?php
    //Config muss hier nicht eingebunden werden, da der Manager diese bereits einbindet.
    include_once($_SERVER['DOCUMENT_ROOT']. "/components/Suche/ergebnisse.php");
    //echo "<pre>";
    //print_r();

    global $aktuellesProgramm;
    $aktuellesProgramm->aktualisieren();

    $movies = $aktuellesProgramm->gibAlleFilme();
    $genres = $aktuellesProgramm->gibAlleGenre();
    $standort = $aktuellesProgramm->gibAlleStandorte();
    ?>
    <div class="wrapper" id="SearchBar">
    <form method="POST" onsubmit="validateForm()">
      <div class="row">
          <div class="col-3">
              <select id ="standort" class="form-control" text="Standort" name="standort" required>
                  <option>Standort</option>
                  <?php
                  foreach($standort as $key => $val)
                  {
                      echo '<option value="'.$val["stadt"].'">'.$val["stadt"].'</option>';
                  }
                  ?>
              </select>
          </div>
          <div class="col-3">
          <select id ="movie" class="form-control" name="movie">
            <option>Alle Filme</option>
            <?php
              foreach($movies as $key => $val)
              {
                echo '<option value="'.$val["titel"].'">'.$val["titel"].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-3">
          <select id="genre" class="form-control" name="genre">
            <option value="Genres">Genres</option>
           <?php
              foreach($genres as $key => $val)
              {
                echo '<option value="'.$val["bezeichnung"].'">'.$val["bezeichnung"].'</option>';
              }
            ?>
          </select>
        </div>
        <div class="col-3">
           <input id="date" type="date" class="form-control" name="date" id ="date" required>
        </div>

        </div>
        <div class="col-4 mt-3 ButtonMitte">
          <input class="btn btn-outline-secondary" style="width:100%; color: black; border-color: gray;" type="submit" name="submit" value="Suchen"/>

        </div>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
    $(document).ready(function(){
      $('[type="date"]').prop('min', function(){
              return new Date().toJSON().split('T')[0];
      });
      $('[type="date"]').prop('value', function(){
          return new Date().toJSON().split('T')[0];
      });
      $('[type="date"]').prop('max',function(){
          date1 = new Date();
          date= new Date(date1.getFullYear(),date1.getMonth()+2,0);
          return date.toJSON().split('T')[0];
      })

      $("[name=submit]").prop('disabled',true);
      $("[name=movie]").hide();
      $("[name=genre]").hide();
      $("[name=date]").hide();

      $("[name=standort]").change(function() {
          if (($('#standort').val()) !== "Standort") {
              $("[name=submit]").prop('disabled',false);
              $("[name=genre]").val("Action");
              $("[name=movie]").val("Alle Filme");
              $("[name=movie]").show(1000);
              $("[name=genre]").show(1000);
          }
          if (($('#standort').val()) == "Standort") {
              $("[name=submit]").prop('disabled',true);
              $("[name=movie]").hide(1000);
              $("[name=genre]").hide(1000);
              $("[name=date]").hide(1000);
          }

      });
      $("[name=genre]").change(function(){$("[name=date]").show(1000);});
      $("[name=movie]").change(function() {
          if (($('#movie').val()) !== "Alle Filme") {
              $("[name=genre]").val("Genres");
              $('#genre option[value=Genres]').attr('selected','selected');
              $("[name=genre]").hide(1000);
              $("[name=date]").show(1000);
          } else {
              $("[name=genre]").val("Action");
              $("[name=genre]").show(1000);

              $("[name=date]").show(1000);

          }
      });
    });
    function validateForm(){
      var parameters = getParametersFromFilter();
      $.ajax({
          url: './components/Suche/ergebnisse.php',
          type:'POST',
          dataType:'json',
          data: {
              parameter: parameters,
          },
          success:function(data){
              window.alert("success"+data);
          }

      });
    };
    function getParametersFromFilter()
    {
      if(($('#standort').val()) !== "Standort")
      {
         var parStandort = $('#standort').val();
      }
      if(($('#movie').val()) !== "Filme")
        {
         var parFilme = $('#movie').val();
        }
      if(($('#genre').val()) !== "Genres")
      {
         var parGenres = $('#genre').val();
      }
      if(($('#date').val()) !== "") {
          var parDate = $('#date').val();
      }
    let parameters = new Array();

      if(parStandort != undefined){parameters["stadt"] = parStandort;}
      if(parFilme != undefined){parameters["titel"] = parFilme;}
      if(parGenres != undefined){parameters["bezeichnung"] = parGenres;}
      if(parDate != undefined){parameters["datum"] = parDate;}

    return parameters;

    }

    </script>
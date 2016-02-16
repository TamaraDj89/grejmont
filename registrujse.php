<?php 
  session_start();

  $title = "Početna";

  include_once('head.php');
  include_once('header.php');

  $greske = array();

  if(isset($_POST['registrujse'])){
    $korisnickoIme = $_POST['korisnickoIme'];
    $lozinka = $_POST['lozinka'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];

    $re_korImeLozinka = "/^[A-z0-9]{5,30}$/";
    $re_email = "/^[A-z0-9\._-]+". "@". "[A-z0-9][A-z0-9-]*". "(\.[A-z0-9_-]+)*". "\.([A-z]{2,6})$/";
    $re_telefon = "/^06[01234569]{1}[0-9]{6,7}$/";

    if(!preg_match($re_korImeLozinka, $korisnickoIme)){
      $greske['korisnickoIme'] = "Samo brojevi i slova od 6 do 30";
    }

    if(!preg_match($re_korImeLozinka, $lozinka)){
      $greske['lozinka'] = "Samo brojevi i slova od 6 do 30";
    }else{
      $lozinkaMd5 = md5($lozinka);
    }

    if(!preg_match($re_email, $email)){
      $greske['email'] = "Neispravan format";
    }

    if(!preg_match($re_telefon, $telefon)){
      $greske['telefon'] = "Unesite broj telefona za Srbiju";
    }

    if(count($greske) == 0){
      $upit_korisnici = "SELECT * FROM korisnici WHERE korisnickoIme='" . $korisnickoIme . "'";
      $rez_korisnici = mysql_query($upit_korisnici, $konekcija);

      if($rez_korisnici){
        if(mysql_num_rows($rez_korisnici) > 0){
          $greske['ispis'] = "Izaberite drugo korisničko ime";
        }else{
          $upit_registracija = "INSERT INTO korisnici VALUES('','2','$korisnickoIme','$email','$telefon','$lozinkaMd5','0')";
          $rez_registracija = mysql_query($upit_registracija, $konekcija);

          if($rez_registracija){
            $upit_potvrda = "SELECT LAST_INSERT_ID()as last FROM korisnici";
            $rez_potvrda = mysql_query($upit_potvrda, $konekcija);

            if($rez_potvrda){
              $potvrda = mysql_fetch_array($rez_potvrda);

              $url = "http://localhost/grejmont/potvrda.php?idKorisnika=" . $potvrda['last'];

              if(mail($email,'Email sa Grejmont D.O.O - Potvrda',$url ,'From: '. $email . "\r\n" .
                'Reply-To: ' . $email . "\r\n")){
                $greske['ispis'] = "Uspešno ste kreirali nalog<br/>Potvrdite svoj nalog preko email-a";
              }
            }
          }
        }
      }
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Registruj se</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol>
              <li>
                <label for="korisnickoIme">Korisničko ime</label>
                <input id="korisnickoIme" name="korisnickoIme" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['korisnickoIme'])){
                    echo $greske['korisnickoIme'];
                  }
                 ?>
              </li>
              <li>
                <label for="lozinka">Lozinka</label>
                <input type="password" id="lozinka" name="lozinka" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['lozinka'])){
                    echo $greske['lozinka'];
                  }
                 ?>
              </li>
              <li>
                <label for="email">Email</label>
                <input id="email" name="email" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['email'])){
                    echo $greske['email'];
                  }
                 ?>
              </li>
              <li>
                <label for="telefon">Telefon</label>
                <input id="telefon" name="telefon" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['telefon'])){
                    echo $greske['telefon'];
                  }
                 ?>
              </li>
              <li>
                <input type="submit" name="registrujse" id="imageField" src="images/submit.gif" class="send" value="Registruj se"/>
                <div class="clr"></div>
                <?php 
                  if(isset($greske['ispis'])){
                    echo $greske['ispis'];
                  }
                 ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  if(isset($_GET['korisnik'])){
    $id = $_GET['korisnik'];
  }

  $greske = array();
  if(isset($_POST['submit'])){
    $lozinka = $_POST['lozinka'];
    $email = $_POST['email'];
    $telefon = $_POST['telefon'];
    $id = $_POST['id'];

    $re_korImeLozinka = "/^[A-z0-9]{5,30}$/";
    $re_email = "/^[A-z0-9\._-]+". "@". "[A-z0-9][A-z0-9-]*". "(\.[A-z0-9_-]+)*". "\.([A-z]{2,6})$/";
    $re_telefon = "/^06[01234569]{1}[0-9]{6,7}$/";


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
      $upit_izmena = "UPDATE korisnici SET lozinka='$lozinkaMd5',email='$email',telefon='$telefon' WHERE idKorisnika='" . $id . "'";
      $rez_izmena = mysql_query($upit_izmena, $konekcija);

      if($rez_izmena){
        $greske['ispis'] = "Izmena uspešna";
      }
    }
  }

  $upit_korisnik = "SELECT * FROM korisnici WHERE idKorisnika='" . $id . "'";
  $rez_korisnik = mysql_query($upit_korisnik, $konekcija);

  if($rez_korisnik){
    if(mysql_num_rows($rez_korisnik) == 1){
      $korisnik = mysql_fetch_array($rez_korisnik);
    }
  }
  
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Korisnik</span></h2>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol>
              <li>
                <label for="korisnickoIme">Korisničko ime</label>
                <input id="korisnickoIme" name="korisnickoIme" class="text" value="<?php echo $korisnik['korisnickoIme']; ?>" disabled="disabled"/>
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
                <input id="email" name="email" class="text" value="<?php echo $korisnik['email']; ?>"/>
                <div class="clr"></div>
                <?php 
                  if(isset($greske['email'])){
                    echo $greske['email'];
                  }
                 ?>
              </li>
              <li>
                <label for="telefon">Telefon</label>
                <input id="telefon" name="telefon" class="text" value="<?php echo $korisnik['telefon']; ?>"/>
                <div class="clr"></div>
                <?php 
                  if(isset($greske['telefon'])){
                    echo $greske['telefon'];
                  }
                 ?>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni korisnika"/>
                <input type="hidden" name="id" value="<?php echo $korisnik['idKorisnika']; ?>">
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
          <div class="clr"></div>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


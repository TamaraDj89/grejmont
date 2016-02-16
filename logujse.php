<?php 
  session_start();

  $title = "Početna";

  include_once('head.php');
  include_once('header.php');

  $greske = array();

  if(isset($_POST['ulogujse'])){
    $korisnickoIme = $_POST['korisnickoIme'];
    $lozinka = md5($_POST['lozinka']);

    $upit_logovanje = "SELECT * FROM korisnici k JOIN uloge u ON k.idUloge=u.idUloge WHERE k.korisnickoIme='" . $korisnickoIme . "' AND k.lozinka='" . $lozinka . "' AND k.status=1";
    $rez_logovanje = mysql_query($upit_logovanje, $konekcija);

    if($rez_logovanje){
      if(mysql_num_rows($rez_logovanje) == 1){
        $korisnik = mysql_fetch_array($rez_logovanje);

        $_SESSION['idKorisnika'] = $korisnik['idKorisnika'];
        $_SESSION['uloga'] = $korisnik['naziv'];

        echo $_SESSION['idKorisnika'];
        echo $_SESSION['uloga'];

        header("Location:index.php");
      }else{
        $greske['ispis'] = "Netačni podaci";
      }
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Loguj se</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="korisnickoIme">Korisničko ime</label>
                <input type="text" id="korisnickoIme" name="korisnickoIme" class="text" />
              </li>
              <li>
                <label for="lozinka">Lozinka</label>
                <input type="password" id="lozinka" name="lozinka" class="text" />
              </li>
              <li>
                <input type="submit" name="ulogujse" id="imageField" src="images/submit.gif" class="send" value="Uloguj se" />
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
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


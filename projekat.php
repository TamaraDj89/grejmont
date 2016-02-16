<?php 
  session_start();

  $title = "Naši projekti";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <?php 
            $idProjekta = $_GET['projekat'];
            $upit_projekti = "SELECT * FROM projekti p JOIN korisnici k ON p.idKorisnika=k.idKorisnika WHERE idProjekta='" . $idProjekta . "'";
            $rez_projekti = mysql_query($upit_projekti, $konekcija);

            $prebroj = "SELECT COUNT(*) as broj FROM komentariprojekta kp JOIN korisnici ko ON kp.idKorisnika=ko.idKorisnika WHERE kp.idProjekta='" . $idProjekta . "'";
            $rez_prebroj = mysql_query($prebroj, $konekcija);

            if($rez_prebroj){
              $broj = mysql_fetch_array($rez_prebroj);
            }

            if($rez_projekti){
              if(mysql_num_rows($rez_projekti) == 1){
                $projekat = mysql_fetch_array($rez_projekti);
              }
            }
           ?>
          <h2><span><?php echo $projekat['nazivProjekta']; ?></span></h2>
          <div class="clr"></div>
          <p>Objavio <b><?php echo $projekat['korisnickoIme']; ?></b> <?php echo date('d.m.Y H:i:s', $projekat['datum']); ?></p>
          <img src="images/projekti/<?php echo $projekat['slikaProjekta']; ?>" width="300"alt="<?php echo $projekat['nazivProjekta']; ?>" />
          <p><?php echo $projekat['opisProjekta']; ?> </p>
          <div class="clr"></div>
        </div>
        <div class="article">
          <h2><span>Ostavi komentar</span></h2>
          <div class="clr"></div>
          <?php 
            if(isset($_SESSION['uloga'])){
           ?>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>?projekat=<?php echo $idProjekta; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="komentar">Komentar</label>
                <textarea id="komentar" name="komentar" rows="2" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" name="napisikomentar" id="imageField" src="images/submit.gif" value="Napiši komentar" />
                <input type="hidden" name="id" value="<?php echo $projekat['idProjekta']; ?>">
                <div class="clr"></div>
                <?php 
                  if(isset($_POST['napisikomentar'])){
                    $komentar = $_POST['komentar'];
                    $idKorisnika = $_SESSION['idKorisnika'];
                    $id = $_POST['id'];
                    $datum = time();
                    
                    $upit_dodavanje = "INSERT INTO komentariprojekta VALUES('','$id','$idKorisnika','$komentar','0','$datum')";
                    $rez_dodavanje = mysql_query($upit_dodavanje, $konekcija);

                    if($rez_dodavanje){
                      echo "Komentar uspešno poslat na odobravanje";
                    }
                  }
                 ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <?php 
            }else{
              echo "<p>Morate biti ulogovani</p>";
            }
           ?>
        </div>
        <div class="article">
          <h2><span><?php echo $broj['broj']; ?></span> Komentara</h2>
          <?php 
            $upit_komentari = "SELECT * FROM komentariprojekta kp JOIN korisnici ko ON kp.idKorisnika=ko.idKorisnika WHERE kp.idProjekta='" . $idProjekta . "' AND kp.status=1 ORDER BY kp.idKomentara DESC";
            $rez_komentari = mysql_query($upit_komentari, $konekcija);

            if($rez_komentari){
              while($komentar = mysql_fetch_array($rez_komentari)){
                ?>
          <div class="comment">
            <p><strong><?php echo $komentar['korisnickoIme']; ?></strong><br />
              <?php echo date('d.m.Y H:i:s', $komentar['datum']); ?></p>
            <p><?php echo $komentar['komentar']; ?></p>
          </div>
          <?php 
              }
            }
           ?>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


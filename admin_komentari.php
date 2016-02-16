<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Komentari projekata</span></h2>
          <div class="clr"></div>
          <?php 
            if(isset($_GET['odobri'])){
              $odobri = $_GET['odobri'];

              $upit_odo = "UPDATE komentariprojekta SET status='1' WHERE idKomentara='" . $odobri . "'";
              $rez_od = mysql_query($upit_odo, $konekcija);
            }

            if(isset($_GET['izbrisi'])){
              $izbrisi = $_GET['izbrisi'];

              $upit_bri = "DELETE FROM komentariprojekta WHERE idKomentara='" . $izbrisi . "'";
              $rez_bri = mysql_query($upit_bri, $konekcija);
            }

            $upit_komentari = "SELECT * FROM komentariprojekta kp JOIN korisnici ko ON kp.idKorisnika=ko.idKorisnika WHERE kp.status=0 ORDER BY kp.idKomentara DESC";
            $rez_komentari = mysql_query($upit_komentari, $konekcija);

            if($rez_komentari){
              while($komentar = mysql_fetch_array($rez_komentari)){
                ?>
          <div class="comment">
            <p><strong><?php echo $komentar['korisnickoIme']; ?></strong><br />
              <?php echo date('d.m.Y H:i:s', $komentar['datum']); ?></p>
            <p><?php echo $komentar['komentar']; ?></p>
            <p><a href="admin_komentari.php?odobri=<?php echo $komentar['idKomentara']; ?>" style="float:left;">Odobri komentar</a></p>
            <p><a href="admin_komentari.php?izbrisi=<?php echo $komentar['idKomentara']; ?>" style="float:right;">Izbriši komentar</a></p>
          </div>
          <?php 
              }
            }
           ?>
          <div class="clr"></div>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


<?php 
  session_start();

  $title = "Potvrda naloga";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <h2>Potvrda naloga</h2>
          <?php 
            $idKorisnika = $_GET['idKorisnika'];
            $upit_potvrda = "UPDATE korisnici SET status='1' WHERE idKorisnika='" . $idKorisnika . "'";
            $rez_potvrda = mysql_query($upit_potvrda, $konekcija);
            if($rez_potvrda){
              echo "<h4>Uspešno ste aktivirali svoj profil</h4>";
            }
           ?>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


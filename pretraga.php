<?php 
  session_start();

  $title = "Pretraga";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <h2>Rezultati pretrage</h2>
          <?php 
            $projekat = $_GET['projekat'];

            $upit_projekti = "SELECT * FROM projekti p JOIN korisnici k ON p.idKorisnika=k.idKorisnika WHERE nazivProjekta LIKE '%" . $projekat . "%' LIMIT 10";
            $rez_projekti = mysql_query($upit_projekti, $konekcija);

            if($rez_projekti){
              while($projekat = mysql_fetch_array($rez_projekti)){
           ?>
          <h3><span><?php echo $projekat['nazivProjekta']; ?></span></h3>
          <div class="clr"></div>
          <p>Objavlio <b><?php echo $projekat['korisnickoIme']; ?></b> <?php echo date('d.m.Y H:i:s', $projekat['datum']); ?></p>
          <img src="images/projekti/<?php echo $projekat['slikaProjekta']; ?>" width="300"alt="<?php echo $projekat['nazivProjekta']; ?>" />
          <p><?php echo substr($projekat['opisProjekta'], 0, 100); ?></p>
          <div class="clr"></div>
          <p><a href="projekat.php?projekat=<?php echo $projekat['idProjekta']; ?>">Pročitaj ceo tekst</a></p>
          <div class="clr"></div>
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


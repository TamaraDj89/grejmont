<?php 
  session_start();

  $title = "Početna";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <?php 
            $upit_projekti = "SELECT * FROM projekti p JOIN korisnici k ON p.idKorisnika=k.idKorisnika LIMIT 3";
            $rez_projekti = mysql_query($upit_projekti, $konekcija);

            if($rez_projekti){
              while($projekat = mysql_fetch_array($rez_projekti)){
           ?>
          <h2><span><?php echo $projekat['nazivProjekta']; ?></span></h2>
          <div class="clr"></div>
          <p>Objavio <b><?php echo $projekat['korisnickoIme']; ?></b> <?php echo date('d.m.Y H:i:s', $projekat['datum']); ?></p>
          <img src="images/projekti/<?php echo $projekat['slikaProjekta']; ?>" width="300"alt="<?php echo $projekat['nazivProjekta']; ?>" />
          <p><?php echo substr($projekat['opisProjekta'], 0, 250); ?> ...</p>
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


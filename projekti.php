<?php 
  session_start();

  $title = "Projekti";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <?php 
            if(isset($_GET['s'])){
                $s = $_GET['s'];
            }else{
                $s = 0;
            }
                        
            $broj_zapisa = 3;
            $desno = $s+ $broj_zapisa;
            $levo= $s - $broj_zapisa;


            $upit_b = "SELECT COUNT(*) as broj FROM projekti";
            $brojevi = mysql_query($upit_b, $konekcija);
            if($brojevi){
                $broj_u = mysql_fetch_array($brojevi);
                $broj = $broj_u['broj'];
            }

            $upit_projekti = "SELECT * FROM projekti p JOIN korisnici k ON p.idKorisnika=k.idKorisnika LIMIT " . $broj_zapisa . " OFFSET " . $s;
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
              echo "<div id='paggination' style='width:100%;'>";
                if($broj<=$broj_zapisa){
                }else if($levo<0){
                    echo "<a href='projekti.php?s=$desno' class='right' style='float:right;font-weight:bold;'></a>";
                }else if($desno>=$broj){
                    echo "<a href='projekti.php?s=$levo' class='left' style='float:left;font-weight:bold;'></a>";
                }else if($levo>=0&&$desno<$broj){
                    echo "<a href='projekti.php?s=$levo' class='left' style='float:left;font-weight:bold;'></a><a href='projekti.php?s=$desno' style='float:right;font-weight:bold;' class='right'></a>";
                }
                echo "</div>";
            }
           ?>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>

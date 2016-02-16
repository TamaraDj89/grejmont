<?php 
  session_start();

  $title = "Ponuda";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <?php 
            $meni = $_GET['meni'];

            $upit_artikli = "SELECT * FROM artikli a JOIN meni m ON a.idMenija=m.idMenija WHERE a.idMenija='" . $meni . "'";
            $rez_artikli = mysql_query($upit_artikli, $konekcija);

            $upit_meni = "SELECT * FROM meni WHERE idMenija='" . $meni . "'";
            $rez_meni = mysql_query($upit_meni, $konekcija);

            if($rez_meni){
              if(mysql_num_rows($rez_meni) == 1){
                $m = mysql_fetch_array($rez_meni);

                echo "<h2>" . $m['nazivMenija'] . "</h2>";
              }
            }

            if($rez_artikli){
              while($artikal = mysql_fetch_array($rez_artikli)){
                echo "<div id='artikal' style='text-align:center;width:140px;float:left;margin:5px 30px;'>";
                echo "<h4>" . $artikal['nazivArtikla'] . "</h4>";
                echo "<img src='images/artikli/" . $artikal['slika'] . "' width='140px' height='140px;'/>";
                echo '<div class="clr"></div>';
                echo "<p>Cena: " . $artikal['cena'] . " RSD</p>";
                echo "</div>";
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


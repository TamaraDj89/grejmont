<?php 
  session_start();

  $title = "Galerija";
  
  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <?php 
            $upit_slike = "SELECT * FROM galerija ORDER BY idSlike DESC";
            $rezultat_slike = mysql_query($upit_slike, $konekcija);

            if($rezultat_slike){
              while($slika = mysql_fetch_array($rezultat_slike)){
           ?>
          <a href="images/galerija/<?php echo $slika['slika']; ?>" class="fancybox" data-fancybox-group="gallery" title="<?php echo $slika['nazivSlike']; ?>">
          <img src="images/galerija/male/<?php echo $slika['slika']; ?>" width="100" height="100" alt="<?php echo $slika['nazivSlike']; ?>" /></a>
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


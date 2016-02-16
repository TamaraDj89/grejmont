  </div>
  <div class="fbg">
    <div class="fbg_resize">
      <div class="col c1">
        <h2><span>Najnovije slike</span></h2>
        <?php 
          $upit_slike = "SELECT * FROM galerija ORDER BY idSlike DESC LIMIT 3";
          $rezultat_slike = mysql_query($upit_slike, $konekcija);

          if($rezultat_slike){
            while($slika = mysql_fetch_array($rezultat_slike)){
         ?>
        <a href="images/galerija/<?php echo $slika['slika']; ?>" class="fancybox" data-fancybox-group="gallery" title="<?php echo $slika['nazivSlike']; ?>">
        <img src="images/galerija/male/<?php echo $slika['slika']; ?>" width="58" height="58" alt="<?php echo $slika['nazivSlike']; ?>" /></a>
		    <?php 
            }
          }
         ?>
	    </div>
      <div class="col c2">
        <h2></h2>
        <p></p>
      </div>
      <div class="col c3">
        <h2><span>Kontakt</span></h2>
        <p>Adresa: <b>Kosmajska 1a, Grocka</b><br/>
        Grad: <b>Beograd</b><br/>
        Telefon: <b>063123456</b><br/>
        Email: <b>grejmont@gmail.com</b><br/>
      </div>
      <div class="clr"></div>
    </div>
    <div class="footer">
      <p class="lf">Copyright &copy; 2013 <a href="index.php">Grejmont D.O.O</a></p>
      <p class="rf">Design <a href="http://all-free-download.com/free-website-templates/">Free CSS Templates</a></p>
      <div class="clr"></div>
    </div>
  </div>
</div>
<!-- END PAGE SOURCE -->
</body>
</html>
<?php 
  mysql_close($konekcija);
 ?>
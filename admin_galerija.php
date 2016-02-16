<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');
  include_once('mala_slika.php');

  $greske = array();
  if(isset($_POST['submit'])){
    $naziv = $_POST['nazivSlike'];
    $slika = $_FILES['slika'];
    $naziv_slike = $slika['name'];
    $tmp_slika = $slika['tmp_name'];
    $tip_slike = $slika['type'];

    if($tip_slike != 'image/jpg' && $tip_slike != 'image/jpeg' && $tip_slike != 'image/png'){
      $greske['slika'] = "Morate izabrati sliku";
    }

    if(count($greske) == 0){
      if(move_uploaded_file($tmp_slika, 'images/galerija/' . $naziv_slike)){
        @malaslika("images/galerija/" . $naziv_slike, "images/galerija/male/" . $naziv_slike, 150, 150);

        $upit_slika = "INSERT INTO galerija VALUES('','" . $naziv . "','" . $naziv_slike . "')";
        $rez_slika = mysql_query($upit_slika, $konekcija);

        if($rez_slika){
          $greske['ispis'] = "Slika dodata u galeriju";
        }
      }
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Galerija</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail" enctype="multipart/form-data">
            <ol> 
              <li>
                <label for="nazivSlike">Naziv slike</label>
                <input type="text" id="nazivSlike" name="nazivSlike" class="text" />
              </li>
              <li>
                <label for="slika">Slika</label>
                <input type="file" id="slika" name="slika" class="text" style="height:25px;"/>
                <div class="clr"></div>
                <?php if(isset($greske['slika'])){echo $greske['slika'];} ?>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Dodaj sliku" />
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
          <h2>Slike u galeriji</h2>
          <?php 
            if(isset($_GET['id'])){
              $id = $_GET['id'];

              $upit_brisanje = "DELETE FROM galerija WHERE idSlike='" . $id . "'";
              $rez_brisanje = mysql_query($upit_brisanje, $konekcija);
            }

            $upit_slike = "SELECT * FROM galerija ORDER BY idSlike DESC";
            $rezultat_slike = mysql_query($upit_slike, $konekcija);

            if($rezultat_slike){
              while($slika = mysql_fetch_array($rezultat_slike)){
           ?>
           <div style="display:block;width:100px;float:left;padding:20px;">
          <a href="images/galerija/<?php echo $slika['slika']; ?>" class="fancybox" data-fancybox-group="gallery" title="<?php echo $slika['nazivSlike']; ?>">
          <img src="images/galerija/male/<?php echo $slika['slika']; ?>" width="100" height="100" alt="<?php echo $slika['nazivSlike']; ?>" /></a>
          <a href="admin_galerija.php?id=<?php echo $slika['idSlike']; ?>">Izbriši</a>
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


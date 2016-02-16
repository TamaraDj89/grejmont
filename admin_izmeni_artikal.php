<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');
  include_once('mala_slika.php');

  if(isset($_GET['artikal'])){
    $id = $_GET['artikal'];
  }

  $greske = array();
  if(isset($_POST['submit'])){
    $nazivArtikla = $_POST['nazivArtikla'];
    $idMenija = $_POST['idMenija'];
    $cena = $_POST['cena'];
    $slika = $_FILES['slika'];
    $id = $_POST['id'];

    $naziv_slike = $slika['name'];
    $tmp_slika = $slika['tmp_name'];
    $tip_slike = $slika['type'];

    if($idMenija == '0'){
      $greske['idMenija'] = "Izaberite meni";
    }

    if($tip_slike != 'image/jpg' && $tip_slike != 'image/jpeg' && $tip_slike != 'image/png'){
      $greske['slika'] = "Morate izabrati sliku";
    }

    if(count($greske) == 0){
      if(move_uploaded_file($tmp_slika, 'images/artikli/' . $naziv_slike)){
        @malaslika("images/artikli/" . $naziv_slike, "images/artikli/male/" . $naziv_slike, 150, 150);

        $upit_izmena = "UPDATE artikli SET idMenija='$idMenija',nazivArtikla='$nazivArtikla',cena='$cena',slika='$naziv_slike' WHERE idArtikla='" . $id . "'";
        $rez_izmena = mysql_query($upit_izmena, $konekcija);

        if($rez_izmena){
          $greske['ispis'] = "Artikal izmenjen";
        }
      }
    }
  }

  $upit_artikli = "SELECT * FROM artikli WHERE idArtikla='" . $id . "'";
  $rez_artikli = mysql_query($upit_artikli, $konekcija);

  if($rez_artikli){
    if(mysql_num_rows($rez_artikli) == 1){
      $artikal = mysql_fetch_array($rez_artikli);
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Artikli</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail" enctype="multipart/form-data">
            <ol> 
              <li>
                <label for="nazivArtikla">Naziv artikla</label>
                <input type="text" id="nazivSlike" name="nazivArtikla" class="text" value="<?php echo $artikal['nazivArtikla']; ?>"/>
              </li>
              <li>
                <label for="idMenija">Meni</label>
                <select name="idMenija" class="text">
                  <option value="0">Izaberi</option>
                  <?php 
                    $upit_meni = "SELECT * FROM meni";
                    $rez_meni = mysql_query($upit_meni, $konekcija);

                    if($rez_meni){
                      while($meni = mysql_fetch_array($rez_meni)){
                        echo "<option value='" . $meni['idMenija'] . "'>" . $meni['nazivMenija'] . "</option>";
                      }
                    }
                   ?>
                </select>
                <div class="clr"></div>
                <?php if(isset($greske['idMenija'])){echo $greske['idMenija'];} ?>
              </li>
              <li>
                <label for="cena">Cena</label>
                <input type="text" id="cena" name="cena" class="text" value="<?php echo $artikal['cena']; ?>"/>
              </li>
              <li>
                <label for="slika">Slika</label>
                <input type="file" id="slika" name="slika" class="text" style="height:25px;"/>
                <div class="clr"></div>
                <?php if(isset($greske['slika'])){echo $greske['slika'];} ?>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni artikal" />
                <input type="hidden" name="id" value="<?php echo $artikal['idArtikla']; ?>">
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


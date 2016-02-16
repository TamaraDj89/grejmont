<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  if(isset($_GET['projekat'])){
    $id = $_GET['projekat'];
  }

  $greske = array();
  if(isset($_POST['submit'])){
    $nazivProjekta = $_POST['nazivProjekta'];
    $slikaProjekta = $_FILES['slikaProjekta'];
    $idKorisnika = $_SESSION['idKorisnika'];
    $id = $_POST['id'];

    $naziv_slike = $slikaProjekta['name'];
    $tmp_slika = $slikaProjekta['tmp_name'];
    $tip_slike = $slikaProjekta['type'];

    $opis = $_POST['opis'];
    $datum = time();

    if($tip_slike != 'image/jpg' && $tip_slike != 'image/jpeg' && $tip_slike != 'image/png'){
      $greske['slika'] = "Morate izabrati sliku";
    }

    if(count($greske) == 0){
      if(move_uploaded_file($tmp_slika, 'images/projekti/' . $naziv_slike)){
        $upit_projekat = "UPDATE projekti SET nazivProjekta='$nazivProjekta',opisProjekta='$opis',slikaProjekta='$naziv_slike' WHERE idProjekta='" . $id . "'";
        $rez_projekat = mysql_query($upit_projekat, $konekcija);

        if($rez_projekat){
          $greske['ispis'] = "Projekat izmenjen";
        }
      }
    }
  }

  $upit_projekat = "SELECT * FROM projekti WHERE idProjekta='" . $id . "'";
  $rez_projekat = mysql_query($upit_projekat, $konekcija);

  if($rez_projekat){
    if(mysql_num_rows($rez_projekat) == 1){
      $projekat = mysql_fetch_array($rez_projekat);
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Projekat</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail" enctype="multipart/form-data">
            <ol> 
              <li>
                <label for="nazivProjekta">Naziv projekta</label>
                <input type="text" id="nazivProjekta" name="nazivProjekta" class="text" value="<?php echo $projekat['nazivProjekta']; ?>"/>
                <div class="clr"></div>
                <?php if(isset($greske['naziv'])){echo $greske['naziv'];} ?>
              </li>
              <li>
                <label for="slikaProjekta">Slika projekta</label>
                <input type="file" id="slikaProjekta" name="slikaProjekta" class="text" style="height:25px;"/>
                <div class="clr"></div>
                <?php if(isset($greske['slika'])){echo $greske['slika'];} ?>
              </li>
              <li>
                <label for="opis">Opis projekta</label>
                <textarea id="opis" name="opis" rows="4" cols="50"><?php echo $projekat['opisProjekta']; ?></textarea>
                <div class="clr"></div>
                <?php if(isset($greske['opis'])){echo $greske['opis'];} ?>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni projekat" />
                <input type="hidden" name="id" value="<?php echo $projekat['idProjekta']; ?>">
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


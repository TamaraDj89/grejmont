<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  $greske = array();
  if(isset($_POST['submit'])){
    $nazivProjekta = $_POST['nazivProjekta'];
    $slikaProjekta = $_FILES['slikaProjekta'];
    $idKorisnika = $_SESSION['idKorisnika'];

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
        $upit_projekat = "INSERT INTO projekti VALUES('','$idKorisnika','$nazivProjekta','$opis','$naziv_slike','$datum')";
        $rez_projekat = mysql_query($upit_projekat, $konekcija);

        if($rez_projekat){
          $greske['ispis'] = "Projekat dodat";
        }
      }
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Meni</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail" enctype="multipart/form-data">
            <ol> 
              <li>
                <label for="nazivProjekta">Naziv projekta</label>
                <input type="text" id="nazivProjekta" name="nazivProjekta" class="text" />
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
                <textarea id="opis" name="opis" rows="4" cols="50"></textarea>
                <div class="clr"></div>
                <?php if(isset($greske['opis'])){echo $greske['opis'];} ?>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Dodaj projekat" />
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
          <h2>Projekti</h2>
          <?php 

            if(isset($_GET['izbrisi'])){
              $id =$_GET['izbrisi'];

              $upit_brisanje = "DELETE FROM projekti WHERE idProjekta='" . $id . "'";
              $rez_brisanje = mysql_query($upit_brisanje, $konekcija);
            }

            $upit_projekti = "SELECT * FROM projekti p JOIN korisnici k ON p.idKorisnika=k.idKorisnika";
            $rez_projekti = mysql_query($upit_projekti, $konekcija);

            if($rez_projekti){
              while($projekat = mysql_fetch_array($rez_projekti)){
           ?>
          <h3><span><?php echo $projekat['nazivProjekta']; ?></span></h3>
          <div class="clr"></div>
          <p>Objavio <b><?php echo $projekat['korisnickoIme']; ?></b> <?php echo date('d.m.Y H:i:s', $projekat['datum']); ?></p>
          <img src="images/projekti/<?php echo $projekat['slikaProjekta']; ?>" width="300"alt="<?php echo $projekat['nazivProjekta']; ?>" />
          <p><?php echo substr($projekat['opisProjekta'], 0, 100); ?></p>
          <div class="clr"></div>
          <p><a href="admin_izmeni_projekat.php?projekat=<?php echo $projekat['idProjekta']; ?>" style="float:left;">Izmeni projekat</a></p>
          <p><a href="admin_projekti.php?izbrisi=<?php echo $projekat['idProjekta']; ?>" style="float:right;">Izbriši projekat</a></p>
          <div class="clr"></div>
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


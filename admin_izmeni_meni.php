<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  if(isset($_GET['meni'])){
    $id = $_GET['meni'];
  }

  $greske = array();
  if(isset($_POST['submit'])){
    $nazivMenija = $_POST['nazivMenija'];
    $id = $_POST['id'];

    $upit_izmena = "UPDATE meni SET nazivMenija='$nazivMenija' WHERE idMenija='" . $id . "'";
    $rez_izmena = mysql_query($upit_izmena, $konekcija);

    if($rez_izmena){
      $greske['ispis'] = "Izmena uspešna";
    }
  }

  $upit_meni = "SELECT * FROM meni WHERE idMenija='" . $id . "'";
  $rez_meni = mysql_query($upit_meni, $konekcija);

  if($rez_meni){
    if(mysql_num_rows($rez_meni) == 1){
      $link = mysql_fetch_array($rez_meni);
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Meni</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="nazivMenija">Naziv</label>
                <input type="text" id="nazivMenija" name="nazivMenija" class="text" value="<?php echo $link['nazivMenija']; ?>"/>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni link" />
                <input type="hidden" name="id" value="<?php echo $link['idMenija']; ?>"/>
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  if(isset($_GET['anketa'])){
    $id = $_GET['anketa'];
  }
  $greske = array();
  if(isset($_POST['submit'])){
    $pitanje = $_POST['pitanje'];
    $id = $_POST['id'];

    $upit_izmena = "UPDATE ankete SET pitanje='$pitanje' WHERE id_ankete='" . $id . "'";
    $rez_izmena = mysql_query($upit_izmena, $konekcija);

    if($rez_izmena){
      $greske['ispis'] = "Anketa izmenjena";
    }
  }

  $upit_anketa = "SELECT * FROM ankete WHERE id_ankete='" . $id . "'";
  $rez_anketa = mysql_query($upit_anketa, $konekcija);

  if($rez_anketa){
    if(mysql_num_rows($rez_anketa) == 1){
      $anketa = mysql_fetch_array($rez_anketa);
    }
  }

 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span><?php echo $anketa['pitanje']; ?></span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="pitanje">Pitanje</label>
                <textarea id="pitanje" name="pitanje" rows="8" cols="50"><?php echo $anketa['pitanje']; ?></textarea>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni pitanje" />
                <input type="hidden" name="id" value="<?php echo $anketa['id_ankete']; ?>">
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


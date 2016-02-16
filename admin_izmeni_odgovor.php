<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

  if(isset($_GET['odgovor'])){
    $id = $_GET['odgovor'];
  }
  $greske = array();
  if(isset($_POST['submit'])){
    $odgovor = $_POST['odgovor'];
    $id = $_POST['id'];

    $upit_izmena = "UPDATE odgovori SET odgovor='$odgovor' WHERE id_odgovora='" . $id . "'";
    $rez_izmena = mysql_query($upit_izmena, $konekcija);

    if($rez_izmena){
      $greske['ispis'] = "Odgovor izmenjen";
    }
  }

  $upit_odgovor = "SELECT * FROM odgovori WHERE id_odgovora='" . $id . "'";
  $rez_odgovor = mysql_query($upit_odgovor, $konekcija);

  if($rez_odgovor){
    if(mysql_num_rows($rez_odgovor) == 1){
      $odgovor = mysql_fetch_array($rez_odgovor);
    }
  }

 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span><?php echo $odgovor['odgovor']; ?></span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="odgovor">Odgovor</label>
                <textarea id="odgovor" name="odgovor" rows="8" cols="50"><?php echo $odgovor['odgovor']; ?></textarea>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Izmeni odgovor" />
                <input type="hidden" name="id" value="<?php echo $odgovor['id_odgovora']; ?>">
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


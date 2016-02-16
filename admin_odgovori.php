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
    $odgovor = $_POST['odgovor'];
    $id = $_POST['id'];

    $upit_dodavanje = "INSERT INTO odgovori VALUES('','$id','$odgovor','0')";
    $rez_dodavanje = mysql_query($upit_dodavanje, $konekcija);

    if($rez_dodavanje){
      $greske['ispis'] = "Odgovor dodat";
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
                <label for="odgovor">Odgovor</label>
                <textarea id="odgovor" name="odgovor" rows="8" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Dodaj odgovor" />
                <input type="hidden" name="id" value="<?php echo $anketa['id_ankete']; ?>">
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
          <h2><span>Odgovori</span></h2>
          <div class="clr"></div>
          <?php
            if(isset($_GET['izbrisi'])){
              $izbrisi = $_GET['izbrisi'];

              $upit_brisanje = "DELETE FROM odgovori WHERE id_odgovora='" . $izbrisi . "'";
              $rez_brisanje = mysql_query($upit_brisanje, $konekcija);
            }

            $upit_odgovori = "SELECT * FROM odgovori WHERE id_ankete='" . $id . "'";
            $rez_odgovori = mysql_query($upit_odgovori, $konekcija);

            if($rez_odgovori){
              echo '<table>';
              echo '<tr>
                      <td>Id</td>
                      <td>Odgovor</td>
                      <td></td>
                    </tr>';
              while($odgovor = mysql_fetch_array($rez_odgovori)){
                echo '<tr>
                          <td>' . $odgovor['id_odgovora'] . '</td>
                          <td><strong>' . $odgovor['odgovor'] . '</strong></td>
                          <td>
                            <a href="admin_odgovori.php?anketa=' . $id . '&izbrisi=' . $odgovor['id_odgovora'] . '"><strong>Izbriši</strong></a> / 
                            <a href="admin_izmeni_odgovor.php?odgovor=' . $odgovor['id_odgovora'] . '"><strong>Izmeni</strong></a>
                          </td>
                      </tr>';
              }
              echo '</table>';
            }
          ?>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


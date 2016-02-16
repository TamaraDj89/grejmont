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
    $pitanje = $_POST['pitanje'];

    $upit_dodavanje = "INSERT INTO ankete VALUES('','$pitanje')";
    $rez_dodavanje = mysql_query($upit_dodavanje, $konekcija);

    if($rez_dodavanje){
      $greske['ispis'] = "Pitanje dodato";
    }
  }

 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Anketa</span></h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol> 
              <li>
                <label for="pitanje">Postavi Pitanje</label>
                <textarea id="pitanje" name="pitanje" rows="8" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Dodaj pitanje" />
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
          <h2><span>Pitanja</span></h2>
          <div class="clr"></div>
          <?php 
            if(isset($_GET['izbrisi'])){
              $id = $_GET['izbrisi'];

              $upit_brisanje = "DELETE FROM ankete WHERE id_ankete='" . $id . "'";
              $rez_brisanje = mysql_query($upit_brisanje, $konekcija);
            }
            $upit_ankete = "SELECT * FROM ankete";
            $rez_ankete = mysql_query($upit_ankete, $konekcija);

            if($rez_ankete){
              echo '<table>';
              echo '<tr>
                      <td>Id</td>
                      <td>Pitanje</td>
                      <td></td>
                    </tr>';
              while($anketa = mysql_fetch_array($rez_ankete)){
                echo '<tr>
                          <td>' . $anketa['id_ankete'] . '</td>
                          <td><strong>' . $anketa['pitanje'] . '</strong></td>
                          <td>
                            <a href="admin_anketa.php?izbrisi=' . $anketa['id_ankete'] . '"><strong>Izbriši</strong></a> / 
                            <a href="admin_izmeni_anketu.php?anketa=' . $anketa['id_ankete'] . '"><strong>Izmeni</strong></a> / 
                            <a href="admin_odgovori.php?anketa=' . $anketa['id_ankete'] . '"><strong>Odgovori</strong></a>
                          </td>
                      </tr>';
              }
              echo '</table>';
            }
           ?>
          <div class="clr"></div>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


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
    $nazivMenija = $_POST['nazivMenija'];

    $upit_dodavanje = "INSERT INTO meni VALUES('','$nazivMenija')";
    $rez_dodavanje = mysql_query($upit_dodavanje, $konekcija);

    if($rez_dodavanje){
      $greske['ispis'] = "Link je dodat";
    }else{
      echo "aaaaa";
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
                <input type="text" id="nazivMenija" name="nazivMenija" class="text" />
              </li>
              <li>
                <input type="submit" name="submit" id="imageField" src="images/submit.gif" class="send" value="Dodaj link" />
                <div class="clr"></div>
                <?php if(isset($greske['ispis'])){echo $greske['ispis'];} ?>
                <div class="clr"></div>
              </li>
            </ol>
          </form>
          <div class="clr"></div>
          <h2>Linkovi u meniju</h2>
          <?php 
            if(isset($_GET['izbrisi'])){
              $id = $_GET['izbrisi'];

              $upit_brisanje = "DELETE FROM meni WHERE idMenija='" . $id . "'";
              $rez_brisanje = mysql_query($upit_brisanje, $konekcija);
            }

            $upit_linkovi = "SELECT * FROM meni";
            $rez_linkovi = mysql_query($upit_linkovi, $konekcija);

            if($rez_linkovi){
              echo '<table>';
              echo '<tr>
                      <td>Id</td>
                      <td>Naziv linka</td>
                      <td></td>
                      <td></td>
                    </tr>';
              while($link = mysql_fetch_array($rez_linkovi)){
                echo '<tr>
                          <td>' . $link['idMenija'] . '</td>
                          <td><a href="ponuda.php?meni=' . $link['idMenija'] . '"><strong>' . $link['nazivMenija'] . '</strong></a></td>
                          <td><a href="administracija.php?izbrisi=' . $link['idMenija'] . '"><strong>Izbriši</strong></a></td>
                          <td><a href="admin_izmeni_meni.php?meni=' . $link['idMenija'] . '"><strong>Izmeni</strong></a></td>
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


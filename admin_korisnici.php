<?php 
  session_start();

  if($_SESSION['uloga'] != 'administrator'){
    header('Location:index.php');
  }

  $title = "Administracija";

  include_once('head.php');
  include_once('admin_header.php');

 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Korisnici</span></h2>
          <?php 
            if(isset($_GET['izbrisi'])){
              $izbrisi = $_GET['izbrisi'];

              $upit_bri = "DELETE FROM korisnici WHERE idKorisnika='" . $izbrisi . "'";
              $rez_bri = mysql_query($upit_bri, $konekcija);
            }

            $upit_korisnici = "SELECT * FROM korisnici k JOIN uloge u ON k.idUloge=u.idUloge";
            $rez_korisnici = mysql_query($upit_korisnici, $konekcija);

            if($rez_korisnici){
              echo '<table>';
              echo '<tr>
                      <td>Id</td>
                      <td>Korisničko ime</td>
                      <td>Uloga</td>
                      <td>Email</td>
                      <td></td>
                    </tr>';
              while($korisnik = mysql_fetch_array($rez_korisnici)){
                echo '<tr>
                          <td>' . $korisnik['idKorisnika'] . '</td>
                          <td><strong>' . $korisnik['korisnickoIme'] . '</strong></td>
                          <td>' . $korisnik['naziv'] . '</td>
                          <td>' . $korisnik['email'] . '</td>
                          <td><a href="admin_korisnici.php?izbrisi=' . $korisnik['idKorisnika'] . '"><strong>Izbriši</strong></a> / 
                          <a href="admin_izmeni_korisnika.php?korisnik=' . $korisnik['idKorisnika'] . '"><strong>Izmeni</strong></a></td>
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


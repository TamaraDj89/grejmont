    <div class="sidebar">
        <div class="gadget">
          <h2>Meni</h2>
          <div class="clr"></div>
          <ul class="sb_menu">
            <?php
              echo '<li><a href="autor.php">Autor</a></li>';
              echo '<li><a href="dokumentacija.pdf">Dokumentacija</a></li>';
              $upit_meni = "SELECT * FROM meni ORDER BY nazivMenija";
              $rez_meni = mysql_query($upit_meni, $konekcija);

              if($rez_meni){
                while($meni = mysql_fetch_array($rez_meni)){
                  echo '<li><a href="ponuda.php?meni=' . $meni['idMenija'] . '">' . $meni['nazivMenija'] . '</a></li>';
                }
              }
             ?>
          </ul>
        </div>
        <div class="gadget">
          <h2>Anketa</h2>
          <div class="clr"></div>
          <?php 
            include_once('anketa.php');
           ?>
        </div>
      </div>
      <div class="clr"></div>
    </div>
<?php 
  session_start();

  $title = "Autor";

  include_once('head.php');
  include_once('header.php');
 ?>
      <div class="mainbar">
        <div class="article">
          <h2>Autor</h2>
          <h3>Student: Tamara Đorđević</h3>
          <h4>Indeks: 206/08</h4>
          <h4>Adresa: Zaklopača, Grocka</h4>
          <h4>O sebi: Student na Visokoj ICT školi u Beogradu.<br/> Završila sam Srednju školu u Grockoj.</h4>
          <img src="images/autor.jpg" style="position:absolute;width:200px;top:160px;margin-left:400px;"/>
          <div class="clr"></div>
        </div>
      </div>
<?php 
  include_once('menu.php');
  include_once('footer.php');
 ?>


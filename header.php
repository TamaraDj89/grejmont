  <div class="header">
    <div class="header_resize">
      <div class="logo">
        <h1><a href="index.php">GREJMONT <span>D.O.O</span></a></h1>
      </div>
      <div class="clr"></div>
      <div class="menu_nav">
        <ul>
          <li><a href="index.php">Početna</a></li>
          <li><a href="projekti.php">Naši projekti</a></li>
          <li><a href="galerija.php">Galerija</a></li>
          <?php 
            if(!isset($_SESSION['uloga'])){
           ?>
          <li><a href="logujse.php">Loguj se</a></li>
          <li><a href="registrujse.php">Registruj se</a></li>
          <?php 
            }else{
           ?>
           <li><a href="izlogujse.php">Izloguj se</a></li>
           <?php 
             }
             if(isset($_SESSION['uloga']) && $_SESSION['uloga'] == "administrator"){
            ?>
            <li><a href="administracija.php">Administracija</a></li>
            <?php              
             } 
            ?>
          <li class="last"><a href="kontakt.php">Kontakt</a></li>
        </ul>
        <div class="search">
          <form id="form" name="form" method="get" action="pretraga.php">
            <span>
            <input name="projekat" type="text" class="keywords" id="uslov" maxlength="50" value="Unesite naziv projekta" />
            </span>
            <input name="pretrazi" type="image" src="images/search.png" class="button" />
          </form>
        </div>
      </div>
      <div class="clr"></div>
    </div>
  </div>
  <div class="clr"></div>
  <div class="content">
    <div class="content_resize">
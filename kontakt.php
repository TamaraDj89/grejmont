<?php 
  session_start();

  $title = "Kontakt";

  include_once('head.php');
  include_once('header.php');


  $greske = array();
  if(isset($_POST['posalji'])){
    $ime = $_POST['ime'];
    $email = $_POST['email'];
    $poruka = $_POST['poruka'];

    $re_ime = "/^[A-z\s]{3,50}$/";
    $re_email = "/^[A-z0-9\._-]+". "@". "[A-z0-9][A-z0-9-]*". "(\.[A-z0-9_-]+)*". "\.([A-z]{2,6})$/";

    if(!preg_match($re_ime, $ime)){
      $greske['ime'] = "Samo slova od 3 - 50 karaktera";
    }

    if(!preg_match($re_email, $email)){
      $greske['email'] = "Neispravan format";
    }

    if(count($greske) == 0){
      if(mail('grejmont@gmail.com','Email sa Grejmont D.O.O',$poruka ,'From: '. $email . "\r\n" .
      'Reply-To: ' . $email . "\r\n")){
        $greske['ispis'] = "Poruka je poslata";
      }
    }
  }
 ?>
      <div class="mainbar">
        <div class="article">
          <h2><span>Pošalji nam</span> email</h2>
          <div class="clr"></div>
          <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" id="sendemail">
            <ol>
              <li>
                <label for="ime">Ime i prezime</label>
                <input id="ime" name="ime" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['ime'])){
                    echo $greske['ime'];
                  }
                 ?>
              </li>
              <li>
                <label for="email">Email</label>
                <input id="email" name="email" class="text" />
                <div class="clr"></div>
                <?php 
                  if(isset($greske['email'])){
                    echo $greske['email'];
                  }
                 ?>
              </li>
              <li>
                <label for="poruka">Vaša poruka</label>
                <textarea id="poruka" name="poruka" rows="8" cols="50"></textarea>
              </li>
              <li>
                <input type="submit" name="posalji" id="imageField" src="images/submit.gif" class="send" value="Pošalji poruku"/>
                <div class="clr"></div>
                <?php 
                  if(isset($greske['ispis'])){
                    echo $greske['ispis'];
                  }
                 ?>
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


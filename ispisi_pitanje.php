<?php 
	$id = $_POST['anketa'];

	include("konekcija.inc");

	$upit_a = "SELECT * FROM ankete WHERE id_ankete='" . $id . "'";
	$ankete = mysql_query($upit_a, $konekcija);
	if($ankete){
		$broj_a = mysql_num_rows($ankete);
		if($broj_a == 1){
			$anketa = mysql_fetch_array($ankete);
			echo "<div class='pitanje'>" .$anketa['pitanje'] . "</div>";
		}
	}

	mysql_close($konekcija);				
 ?>
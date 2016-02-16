<?php
	include("konekcija.inc");

	$anketa = $_POST['anketa'];

	$upit_o = "SELECT * FROM odgovori WHERE id_ankete='" . $anketa . "' ORDER BY id_odgovora";
	$odgovori = mysql_query($upit_o, $konekcija);
	if($odgovori){
		$broj_o = mysql_num_rows($odgovori);
		if($broj_o > 0){
			echo "<div class='odgovor'>";
			$i = 0;
			while($odgovor = mysql_fetch_array($odgovori)){
				if($i == 0){
					echo $odgovor['odgovor'] . "<input type='radio' name='id_odgovora' id='id_odgovora' value='" . $odgovor['id_odgovora'] . "' checked/><br/>";
				}else{
					echo $odgovor['odgovor'] . "<input type='radio' name='id_odgovora' id='id_odgovora' value='" . $odgovor['id_odgovora'] . "'/><br/>";					
				}
				$i++;
			}
			echo "</div>";
		}
	}

	mysql_close($konekcija);
 ?>
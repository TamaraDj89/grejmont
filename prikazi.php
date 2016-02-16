<?php 
	$odgovor = $_POST['odgovor'];
	$anketa = $_POST['anketa'];

	include("konekcija.inc");

	echo "<td class='ispis'>Prikaz rezultata<br/>";
	$upit_o = "SELECT * FROM odgovori WHERE id_ankete='" . $anketa . "'";
	$odgovori = mysql_query($upit_o, $konekcija);
	if($odgovori){
		$broj_o = mysql_num_rows($odgovori);
		if($broj_o > 0){
			$ukupno = 0;
			$brojevi = array();
			while($odgovor = mysql_fetch_array($odgovori)){
				$ukupno += $odgovor['broj'];
				$brojevi[] = $odgovor['broj'];
				$nazivi[] = $odgovor['odgovor'];
			}
			$i = 0;
			foreach($brojevi as $broj){
				@$procenat = round(100 * ($broj / $ukupno), 2);
				echo $nazivi[$i] . "&nbsp;" . $procenat . " %<br/>";
				$i++;
			}
			echo "Ukupno glasova: " . $ukupno;
		}
	}
	echo "</td>";

	mysql_close($konekcija);
 ?>
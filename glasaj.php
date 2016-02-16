<?php 
	$odgovor = $_POST['odgovor'];
	$anketa = $_POST['anketa'];

	include("konekcija.inc");

	$upit_b = "SELECT broj FROM odgovori WHERE id_odgovora='" . $odgovor . "'";
	$brojevi = mysql_query($upit_b, $konekcija);
	$glasovi = 0;
	if($brojevi){
		$broj_b = mysql_num_rows($brojevi);
		if($broj_b == 1){
			$broj = mysql_fetch_array($brojevi);
			$glasovi = $broj['broj'];
		}
	}

	$glasovi++;

	$upit_o = "UPDATE odgovori SET broj='" . $glasovi . "' WHERE id_odgovora='" . $odgovor . "'";
	$glasanje = mysql_query($upit_o, $konekcija);

	if($glasanje){
		echo "<td class='ispis'>Uspesno ste glasali<br/>";
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
					$procenat = round(100 * ($broj / $ukupno), 2);
					echo $nazivi[$i] . "&nbsp;" . $procenat . " %<br/>";
					$i++;
				}
				echo "Ukupno glasova: " . $ukupno;
			}
		}
		echo "</td>";
	}

	mysql_close($konekcija);
 ?>
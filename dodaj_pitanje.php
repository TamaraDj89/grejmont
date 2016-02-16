<?php 
	include("konekcija.inc");

	$pitanje = $_POST['pitanje'];

	$greske = array();

	$re_pitanje = "/^[A-ZŽĆČĐŠ]{1}[A-Za-z0-9ŽĆČĐŠžćčđš\.\,\?\!]{4,30}$/";

	if(!preg_match($re_pitanje, $pitanje)){
		$greske[] = "Pitanje može da sadrži slova i brojeve između 5 i 30 karaktera";
	}

	if(count($greske) == 0){
		$upit_p = "INSERT INTO ankete VALUES('','" . $pitanje . "')";
		$pitanja = mysql_query($upit_p, $konekcija);

		if($pitanja){
			echo "Uspešno";
		}
	}else{
		foreach($greske as $greska){
			echo $greska . ", ";
		}
	}

	mysql_close($konekcija);
 ?>
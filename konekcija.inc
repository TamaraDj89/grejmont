<?php 
	$konekcija = mysql_connect('localhost','root','');
	$utf = mysql_set_charset('utf8');
	$baza = mysql_select_db('grejmont', $konekcija);
 ?>
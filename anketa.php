	<table class='anketa'>
		<form>
			<tr>
				<td>
					<select id="anketa">
						<?php
							include("konekcija.inc");

							$upit_a = "SELECT * FROM ankete";
							$ankete = mysql_query($upit_a, $konekcija);
							if($ankete){
								$broj_a = mysql_num_rows($ankete);
								if($broj_a > 0){
									while($anketa = mysql_fetch_array($ankete)){
										echo "<option value='" . $anketa['id_ankete'] . "'>" . $anketa['pitanje'] . "</option>";
									}
								}
							}
						?>
					</select>
				</td>
			</tr>
			<tr>
				<td>
					<?php 
						$upit_a = "SELECT * FROM ankete LIMIT 1";
						$ankete = mysql_query($upit_a, $konekcija);
						if($ankete){
							$broj_a = mysql_num_rows($ankete);
							if($broj_a == 1){
								$anketa = mysql_fetch_array($ankete);
								echo "<div class='pitanje'>" .$anketa['pitanje'] . "</div>";
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<?php 
						if($broj_a == 1){
							$upit_o = "SELECT * FROM odgovori WHERE id_ankete='" . $anketa['id_ankete'] . "'";
							$odgovori = mysql_query($upit_o, $konekcija);
							if($odgovori){
								$broj_o = mysql_num_rows($odgovori);
								if($broj_o > 0){
									echo "<div class='odgovor'>";
									$i = 0;
									while($odgovor = mysql_fetch_array($odgovori)){
										if($i == 0){
											echo $odgovor['odgovor'] . "<input type='radio' name='id_odgovora' value='" . $odgovor['id_odgovora'] . "' checked/><br/>";
										}else{
											echo $odgovor['odgovor'] . "<input type='radio' name='id_odgovora' value='" . $odgovor['id_odgovora'] . "'/><br/>";					
										}
										$i++;
									}
									echo "</div>";
								}
							}
						}
					?>
				</td>
			</tr>
			<tr>
				<td>
					<input type="button" id="glasaj" value="Glasaj"/>
					<input type="button" id="rezultat" value="Prikaži rezultate"/>
				</td>
				<td>
				</td>
			</tr>
		</form>
	</table>
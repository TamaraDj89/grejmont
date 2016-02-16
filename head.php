<?php 
	include_once('konekcija.inc');
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Grejmont D.O.O - <?php echo $title; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="js/cufon-yui.js"></script>
<script type="text/javascript" src="js/arial.js"></script>
<script type="text/javascript" src="js/cuf_run.js"></script>
<script type="text/javascript" src="fancybox/jquery.fancybox.js?v=2.1.5"></script>
<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox.css?v=2.1.5" media="screen" />
<script type="text/javascript">
	$(document).ready(function(){
		$('#uslov').focus(function(){
			$(this).val('');
		});

		$('.sb_menu li').hover(function(){
			$(this).stop(true, true).animate({'margin-left':'10px'});
		}, function(){
			$(this).stop(true, true).animate({'margin-left':'0px'});
		});

		$(document).ready(function(){
			$("#anketa").change(function(){
				var data = {
					anketa:$(this).val()
				};
				$.ajax({
					url:"ispisi_pitanje.php",
					type:"POST",
					data:data,
					success:function(msg){
						$('.pitanje').html(msg);
					}
				});

				$.ajax({
					url:"ispisi_odgovor.php",
					type:"POST",
					data:data,
					success:function(msg){
						$('.odgovor').html(msg);
					}
				});
			});

			$("#glasaj").click(function(){
				var data = {
					anketa:$("#anketa").val(),
					odgovor:$("input[name='id_odgovora']:checked").val()
				};
				$.ajax({
					url:"glasaj.php",
					type:"POST",
					data:data,
					success:function(msg){
						$('.anketa').html(msg);
					}
				});
			});

			$("#rezultat").click(function(){
				var data = {
					anketa:$("#anketa").val(),
					odgovor:$("input[name='id_odgovora']:checked").val()
				};
				$.ajax({
					url:"prikazi.php",
					type:"POST",
					data:data,
					success:function(msg){
						$('.anketa').html(msg);
					}
				});
			});
		});

		$('.fancybox').fancybox();
		$('.fancyboxfooter').fancybox();
	});
</script>
</head>
<body>
<!-- START PAGE SOURCE -->
<div class="main">
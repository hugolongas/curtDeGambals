<html lang="ca">
<head>
<title>Curt de Gambals - Noticies</title>
<meta name="description" content="Web del festival curt de gambals, aqui podras trobar tota la informacio relacionada amb el festival.">
<meta name="keywords" content="festival, curts, cortos, shortfilm, gambals">
<meta name="author" content="Hugo Longás">
<meta name="contact" content="hugolo3@gmail.com">
<meta name="author" content="Riccardo Di Natale">
<meta name="contact" content="ricci.dinatale@gmail.com">
<meta charset="UTF-8">
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<link rel="stylesheet" href="css/noticies.css" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<?php require("conecta_sql.php"); ?>
	<?php
		$consultaNoticies="SELECT * FROM Noticies_cat ORDER BY creat DESC";
		$ferConsultaNoticies=mysql_query($consultaNoticies,$conectat);
		$totalEv=mysql_num_rows($ferConsultaNoticies);
?>
<div id="moqueta_noti">
<?php for($i=0;$i<$totalEv;$i++){
		$noticia=mysql_result($ferConsultaNoticies,$i,"noticia");
	?>
	<div id="noti_<?php echo($i+1);?>" class="noti">
		<?php echo($noticia);?>		
	</div>
	<?php }?>
</div>
</body>
<script>
as = document.getElementById("noti_1").offsetTop;
parent.document.getElementById("fi").value=as;
</script>
</html>
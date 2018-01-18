<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - Noticies</title>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style type="text/css">
</style>
<script>
$(document).ready(function(){
	$("#crea").click(function(){
		window.open("nova_noticia.php", '_self');
	});
});
</script>
</head>
<body>
<?php require("conecta_sql.php");?>
<h1>NOTICIES</h1>
<?php
		$consultaNoticies="SELECT * FROM Noticies";
		$ferConsultaNoticies=mysql_query($consultaNoticies,$conectat);
		$totalEv=mysql_num_rows($ferConsultaNoticies);
?>
	<button id="crea">Noticia nova</button>
<table>
	<tr>
		<td>TIPUS</td>
		<td>TITOL</td>
		<td>CREAT</td>
		<td>MODIFICAR</td>
		<td>ELIMINAR</td>
	</tr>
 <?php 
		for ($i=0;$i<$totalEv;$i++) {
		$tipus=mysql_result($ferConsultaNoticies,$i,"tipus");
		$titol=mysql_result($ferConsultaNoticies,$i,"titol_cat");
		$creat=mysql_result($ferConsultaNoticies,$i,"creat");

?>
	<tr>
	<td><div id="tit<?php echo($i)?>" style="width:40px;"><?php echo($tipus)?></div></td>
	<td><div id="tit<?php echo($i)?>" style="width:300px;"><?php echo($titol)?></div></td>
	<td><div id="crea<?php echo($i)?>" style="width:100px;"><?php echo($creat)?></div></td>
	<td><form name="modifica_noticia" method="post" action="modi_noticia.php"><button type="submit" name="modificar" id="modi<?php echo($i)?>" value="<?php echo($creat)?>">MODIFICAR</button></form></td>
	<td><form name="elimina_noticia" method="post" action="elim_noticia.php"><button  type="submit" name="eliminar" id="elim<?php echo($i)?>" value="<?php echo($creat)?>">ELIMINAR</button></form></td>
	</tr>
	<?php } ?>
</table>
</body>
</html> 

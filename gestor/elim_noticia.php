<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - Noticies</title>
</head>
<body>
<?php
	require("../conecta_sql.php");
	$data=$_POST["eliminar"];
	$entradaEliminada="DELETE FROM Noticies WHERE creat='$data'; ";
	$consultaEntradaEliminada_cat = mysql_query($entradaEliminada,$conectat);
	
	
?>
</body>
</html> 

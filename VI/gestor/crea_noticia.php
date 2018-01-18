<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - Noticies</title>
</head>
<body>
<?php
	require("../conecta_sql.php");
		$tipus = $_POST["tipus"];
		$tit_cat = $_POST["c_tit_cat"];
		$info_cat = $_POST["c_info_cat"];
		$tit_cas = $_POST["c_tit_cas"];
		$info_cas = $_POST["c_info_cas"];
		$tit_ang = $_POST["c_tit_ang"];
		$info_ang = $_POST["c_info_ang"];

	echo($tit_cat."<br>".$tit_cas."<br>".$tit_ang."<br>".$info_cat."<br>".$info_cas."<br>".$info_ang."<br>".$tipus);
	
	$afegir = "INSERT INTO Noticies (titol_cat, titol_cas,titol_ang,noticia_cat,noticia_cas,noticia_ang,tipus) VALUES ('$tit_cat','$tit_cas','$tit_ang','$info_cat','$info_cas','$info_ang','$tipus');";
	
	$insert = mysql_query($afegir,$conectat);
	echo($insert);

?>
</body>
</html> 

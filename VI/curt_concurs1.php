<?php
	require("conecta_sql.php");
	$votacions="";
	//conectem a la base de dades de control de vots per comprovar si ha votat
	$consulta = "SELECT * FROM control_vots ORDER BY dia_vot ASC;";
	if(!$usuari = $mysqli ->query($consulta)){			die('There was an error running the query: '.$usuari.' [' . $mysqli->error . ']');		}
	$registre = mysql_num_rows($usuari);	$registre = $usuari->num_rows;	echo $registre;	
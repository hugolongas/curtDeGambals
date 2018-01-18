<?php
	require("conecta_sql.php");
	$votacions="";
	$cook = 0;
	$ip_usuari = $_SERVER['REMOTE_ADDR'];
	$usuario = base64_encode($ip_usuari);
	$curt = $_POST["vot"];
	
	$conexio = "SELECT * FROM control_vots WHERE ip_ordinador LIKE '$usuario' ORDER BY dia_vot ASC;";
	$usuari = mysql_query($conexio,$conectat);
	$registre = mysql_num_rows($usuari);
	if($registre >0){
	$votacions = mysql_result($usuari,$registre-1,'curts_votats');
	$cook = 1;
	$diavotacio=mysql_result($usuari,$registre-1,"dia_vot");
	$diavotacio = str_replace("-","",$diavotacio);
	$ara = date("Y-m-d");
	$ara = str_replace("-","",$ara);
	echo($ara);
	echo($diavotacio);
	if($diavotacio<$ara){
			$cook = 0;
			echo("borrat");
			$votacions="";
		}
	}
	//conecto a la base de dades per buscar el registre
	
	//primer obtenim el valor
	$consulta = "SELECT * FROM concurs;";
	$votsCurt = mysql_query($consulta,$conectat);
	$totalCurts = mysql_num_rows($votsCurt);
	for($i = 0; $i < $totalCurts; $i++){
		$vots_v = mysql_result($votsCurt,$i,"vots");
		$id = mysql_result($votsCurt,$i,"id");
			if($id==$curt){
				$vots = $vots_v+1;
			}
	}

	//Ara actualitzem el valor
	$consulta = "UPDATE concurs SET vots=$vots WHERE (id LIKE $curt);";
	$actualitza = mysql_query($consulta,$conectat);
	
	//Ara actualitzem o creem la cookie
	//primer averiguem els curts que hi ha
	//creem
	
	if($cook==0){
		for($i=1;$i<=$totalCurts;$i++){
			if($i<$totalCurts){
				if($curt==$i){
					$votacions .="1|";
				}else{
					$votacions .="0|";
				}
			}else{
				if($curt==$i){
					$votacions .="1";
				}else{
					$votacions .="0";
				}
			}
		}
		//creem la entrada a la base de dades.
		$consultaInsercio = "INSERT INTO control_vots (ip_ordinador,curts_votats,dia_vot) VALUES ('$usuario','$votacions',NOW());";
		$inserto = mysql_query($consultaInsercio,$conectat);

	}else{
		$vots = explode("|",$votacions);
		$vots[$curt-1] = "1";
		$total = count($vots);
		$votacio="";
		for($i=0;$i<$total;$i++){
			if($i<$total-1){
			$votacio.=$vots[$i]."|";
			}else{
			$votacio.=$vots[$i];
			}
		}
		$consultaActualiza = "UPDATE control_vots SET curts_votats ='$votacio' WHERE (ip_ordinador LIKE '$usuario');";
		$inserto = mysql_query($consultaActualiza,$conectat);
	}
 ?>
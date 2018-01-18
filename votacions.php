<?php
	require("conecta_sql.php");
	$votacions="";
	$cook = 0;
	$ip_usuari = $_SERVER['REMOTE_ADDR'];
	$usuario = base64_encode($ip_usuari);
	$curt = $_POST["vot"];
	
	$conexio = "SELECT * FROM curtdegambals_control_vots WHERE ip_ordinador LIKE '$usuario' ORDER BY dia_vot ASC;";
	if(!$usuari = $mysqli ->query($conexio)){
			die('There was an error running the query: '.$conexio.' [' . $mysqli->error . ']');
		}
	$registre = $usuari->num_rows;
	if($registre > 0){		
		$row = $usuari -> fetch_assoc();
	$votacions = $row['curts_votats'];
	$cook = 1;
	$diavotacio=$row['dia_vot'];
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
	$consulta = "SELECT * FROM curtdegambals_concurs WHERE edicio=7;";
	if(!$votsCurt = $mysqli ->query($consulta)){
			die('There was an error running the query: '.$consulta.' [' . $mysqli->error . ']');
		}
	$totalCurts = $votsCurt->num_rows;
	for($i = 0; $i < $totalCurts; $i++){
		$row = $votsCurt -> fetch_assoc();
		$vots_v = $row["vots"];
		$id = $row["id"];
			if($id==$curt){
				$vots = $vots_v+1;
			}
	}

	//Ara actualitzem el valor
	$consultaUpdate = "UPDATE curtdegambals_concurs SET vots=$vots WHERE edicio=7 and id LIKE $curt;";
	if(!$actualiza = $mysqli ->query($consultaUpdate)){
			die('There was an error running the query: '.$consultaUpdate.' [' . $mysqli->error . ']');
		}
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
		$consultaInsercio = "INSERT INTO curtdegambals_control_vots (ip_ordinador,curts_votats,dia_vot) VALUES ('$usuario','$votacions',NOW());";
		if(!$inserto = $mysqli ->query($consultaInsercio)){
			die('There was an error running the query: '.$consultaInsercio.' [' . $mysqli->error . ']');
		}

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
		$consultaActualiza = "UPDATE curtdegambals_control_vots SET curts_votats ='$votacio' WHERE (ip_ordinador LIKE '$usuario');";
		if(!$update = $mysqli ->query($consultaActualiza)){
			die('There was an error running the query: '.$consultaActualiza.' [' . $mysqli->error . ']');
		}
	}
 ?>
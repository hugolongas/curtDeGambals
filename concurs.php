<?php 
	$dataActual = getdate()[0];
	$fecha=getdate(strtotime("01-11-2017"))[0]; 
	if($dataActual<$fecha)
		header("Location: tempor.html");
?>
<!DOCTYPE html>
<html lang="ca">
<head>
<title>Curt de Gambals - Concurs</title>
<meta charset="UTF-8">
<link href="css/concurs.css" rel="stylesheet" type="text/css">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="js/concurs.js"></script>
</head>
<body>
	<div id="cont_concurs">
	<div>
	Titol del curt<input type="text" id="titol_curt"></input>
	<button class="buscar">buscar</button>
	Director del curt<input type="text" id="director_curt"></input>
	<button class="buscar">buscar</button>
	</div>
	<div id="curts">
	<div id="moqueta_curts" style="">
	<?php include("curt_concurs.php");?>
	</div>
	</div>
	<div id="paginas">
	</div>
	</div>
	
</body>
</html>
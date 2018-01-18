<html lang="ca">
<head>
<title>Curt de Gambals - Noticies</title>
<style type="text/css">
body{
	margin:0px;
	color:white;
}
p{
	opacity:0;
}
</style>
</head>
<body>
<?php
	//se declaran los tres parametros
	$destinatari ="curtdegambals@lalianca.cat";
	$asumpte = $_POST["asun"];
	$missatge = $_POST["misa"];
	$de = $_POST["nom"]." <".$_POST["email"].">";
	$remitent = $_POST["email"];
	$cap = "From:$de"."\r\n"."Reply-To:$remitent";
	 if(mail($destinatari,$asumpte,$missatge,$cap)){
			echo("<p id='confirmacio'>Enviat</p>");
		}else{
			echo("<p id='confirmacio'>No enviat</p>");
		}
	echo("destinatari: $destinatari<br>asumpte: $asumpte<br>de: $de<br>respon: $remitent<br>capcelera: $cap");
?>
</body>
<script type="text/javascript">
parent.document.getElementById("enviat").innerHTML=document.getElementById("confirmacio").innerHTML;
parent.document.forms["contacte"]["nom"].value="";
parent.document.forms["contacte"]["email"].value="";
parent.document.forms["contacte"]["asun"].value="";
parent.document.forms["contacte"]["misa"].value="";
setTimeout(function(){parent.document.getElementById("enviat").innerHTML="";},1000);
</script>
</html>
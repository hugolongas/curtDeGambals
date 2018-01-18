<?php
header("Content-Type: text/html;charset=utf-8");
require("conecta_sql.php");
$nom = $_POST["nom"];
$dni = $_POST["dni"];
$naixement = $_POST["naixement"];
$poblacio = $_POST["poblacio"];
$codPostal = $_POST["codPostal"];
$adresa = $_POST["adresa"];
$tel = $_POST["tel"];
$email = $_POST["email"];
$titol_curt = $_POST["titol_curt"];
$sinopsi = $_POST["sinopsi"];
$durada = $_POST["durada"];
$any = $_POST["any"];
$url = $_POST["url"];
$concurs_web = $_POST["concurs_web"];
if($concurs_web == '')
	$concurs_web = 0;

$sinopsi = str_replace('"','\"',$sinopsi);
$consultaInserto = 'INSERT INTO curtdegambals_curts (director,dni,data_naixement,poblacio,codi_postal,adresa,telefon,email,titol,sinopsis_cat,durada,any,enll,concurs_web,edicio) VALUES("'.$nom.'","'.$dni.'","'.$naixement.'","'.$poblacio.'","'.$codPostal.'","'.$adresa.'","'.$tel.'","'.$email.'","'.$titol_curt.'","'.$sinopsi.'",'.$durada.','.$any.',"'.$url.'",'.$concurs_web.',7)';
if(!$result = $mysqli ->query($consultaInserto)){
			die('There was an error running the query: '.$consultaInserto.' [' . $mysqli->error . ']');
		}
		
if($concurs_web ==1)
{
$consultaConcurs = 'INSERT INTO curtdegambals_concurs (titol,any,director,sinopsis_cat,enll,vots,edicio) VALUES("'.$titol_curt.'",'.$any.',"'.$nom.'","'.$sinopsi.'","'.$url.'",0,7)';
if(!$result = $mysqli ->query($consultaConcurs)){
			die('There was an error running the query: '.$consultaConcurs.' [' . $mysqli->error . ']');
		}	
}
		
	/*Inscripció director */
	$destinatari =$email;
	$asumpte = "Inscripció curt de Gambals";
	$missatge = "Ja está inscrit al festival, moltes Gracies";
	$de ="festival Curt de Gambals <curdegambals@lalianca.cat>";
	$remitent = "curtdegambals@lalianca.cat";
	$cap = "From:$de"."\r\n"."Reply-To:$remitent";
	 mail($destinatari,$asumpte,$missatge,$cap);
	 
	 /*Inscripció festival*/
	 $destinatari ="curtdegambals@lalianca.cat";
	$asumpte = "Inscripció curt de Gambals";
	$missatge = "Hi ah una nova inscripció al festival";
	$de ="festival Curt de Gambals <curdegambals@lalianca.cat>";
	$remitent = "curtdegambals@lalianca.cat";
	$cap = "From:$de"."\r\n"."Reply-To:$remitent";
	 mail($destinatari,$asumpte,$missatge,$cap);
		
?>
<!DOCTYPE html>
<html lang="es">
<head>
<title>Curt de Gambals | Concurs de Curtmetratges</title>
<meta http-equiv="content-type" content="text/html; charset=UTF-8" />
<meta name="description" content="Web del festival curt de gambals, aqui podras trobar tota la informació relacionada amb el festival.">
<meta name="keywords" content="festival, curts, cortos, shortfilm, gambals, short, films">
<meta name="author" content="Hugo Longás">
<meta name="contact" content="hugolo3@gmail.com">
<meta name="author" content="Riccardo Di Natale">
<meta name="contact" content="ricci.dinatale@gmail.com">

<link rel="shortcut icon" href="favicon.ico" type="image/x-icon"> 
<link href="css/inscripcio.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="/path/to/shared/js/EventHelpers.js"></script>
<script type="text/javascript" src="/path/to/shared/js/cssQuery-p.js"></script>
<script type="text/javascript" src="/path/to/shared/js/jcoglan.com/sylvester.js"></script>
<script type="text/javascript" src="/path/to/shared/js/cssSandpaper.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<div id="contenedor">
	<div id="header">
		<a href="http://www.curtdegambals.lalianca.cat"><h1 class="tit">CURT DE GAMBALS</h1></a>
		<div  class="logo">
			<a href="http://www.lalianca.cat" target="_blank"><img src="img/alianca-logo.png" alt="logo ateneu l'aliança"></a>
			<div id="idioma">
				<a href="/"><img src="img/catala.png"></a>
				<a href="es/"><img src="img/castellano.png"></a>
				<a href="en/"><img src="img/english.png"></a>
			</div>
		</div>
		<div id="follow">
			<span class="tit_fol">Segeix-nos:</span>
			<a href="https://www.facebook.com/curtdegambals" target="_blank"><img src="img/face.png"></a>
			<a href="http://www.youtube.com/gambals" target="_blank"><img src="img/you.png"></a>
			<a href="https://twitter.com/curtdegambals" target="_blank"><img src="img/twitter.png"></a>
		</div>
	</div>
	<div  id="form_contenidor">
		Ja está Inscrit al festival, en breus moments rebrá un e-mail de confirmació, si no el reves, posis en contacte amb nosaltres per confirmar.
	</div>
</div>
<div id="footer">
<span id="alianca_peu">Ateneu l'Aliança (2013-2014)</span>
<div class="fb-like" data-href="http://www.curtdegambals.lalianca.cat" data-layout="button_count" data-action="like" data-show-faces="false" data-share="true"></div>
<span id="creador">powered: <a href="mailto:hugolo3@gmail.com">Hugo Longás Costa</a></span>
</div>
</body>
</html>

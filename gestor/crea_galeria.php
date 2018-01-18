<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - Noticies</title>
</head>
<body>
<?php
	require("conecta_sql.php");
	$tipus = $_POST["tipus"];
	
	switch("tipus"){
		case "imatge":
			$foto=$_FILE["imatg"];
			$titol = $_POST["titima"];
		break;
		
		case "video":
			$foto = $_FILE["portvid"];
			$titol = $_POST["titvid"];
			$infor = $_POST["infovid"];
		
		case "curt":
			$foto = $_FILE["portcurt"];
			$titol = $_POST["titcurt"];
			$infor = $_POST["infocurt"];
			$direc = $_POST["director"];
			$any = $_POST["amy"];
		break;
	}
	
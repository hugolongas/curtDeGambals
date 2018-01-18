<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - Noticies</title>
</head>
<body>
<?php
	require("conecta_sql.php");
	$consultaNoticies="SELECT * FROM Noticies;";
	$ferConsultaNoticies=mysql_query($consultaNoticies,$conectat);
	$noti=mysql_num_rows($ferConsultaNoticies);
	
		$imgvid = $_POST["imgovid"];
		$tit_cat = $_POST["tit_img_cat"];
		$text_cat = $_POST["info_img_cat"];
		$tit_cas = $_POST["tit_img_cas"];
		$text_cas = $_POST["info_img_cas"];
		$tit_ang = $_POST["tit_img_ang"];
		$text_ang = $_POST["info_img_ang"];
		
		switch($imgvid){
		
		case "imatge":
		$imatgerebuda= $_FILES["imatge"]["tmp_name"];
		$nomfoto=str_replace(" ","_",$tit_cat);
		$desti="../img/norm/".$nomfoto.".jpg";
		move_uploaded_file ($imatgerebuda,$desti);
		//creant la imatge normal i la miniatura
		$imatgeJPG = imagecreatefromjpeg($desti);
		//mirem el ample i el alt per reduir-la 336 189
		$ample=imagesx($imatgeJPG);
		$alt=imagesy($imatgeJPG);
		if($ample>336||$alt>189){
			if($ample>336){
			//si l'ample es més gran:
			$ampleMax = 336;
			$factor = $ample/$ampleMax;
			$altMini= $alt/$factor;
			$ampleMini=$ampleMax;
			}else{$ampleMini=$ample;$altMini=$alt;}
			if($altMini>189){
			//si l'alt es més gran:
			$altMax = 189;
			$factor = $altMini/$altMax;
			$ampleMini= $ampleMini/$factor;
			$altMini = $altMax;
			}
		}else{$altMini = $alt;$ampleMini = $ample;}
		$novaImatge = imagecreatetruecolor($ampleMini,$altMini);
		imagecopyresampled($novaImatge,$imatgeJPG,0,0,0,0,$ampleMini,$altMini,$ample,$alt);
		$destimin="../img/mini/".$nomfoto.".jpg";
		imagejpeg($novaImatge,$destimin);
		imagedestroy($novaImatge);
		imagedestroy($imatgeJPG);
		//un cop redimansionada per la vista previa, ho fem per al galeria aixi que tornem a fer el proces sencer
		//agafem la imatge Carregada
		$imatgeJPG = imagecreatefromjpeg($desti);
		//mirem el ample i el alt per reduir-la
		$ample=imagesx($imatgeJPG);
		$alt=imagesy($imatgeJPG);
		//mirem si es més ample que alta i actuem en concecuencia
		
		if($ample>950||$alt>490){
			if($ample>950){
			//si l'ample es més gran:
			$ampleMax = 950;
			$factor = $ample/$ampleMax;
			$altNormal= $alt/$factor;
			$ampleNormal=$ampleMax;
			}else{$ampleNormal=$ample;$altNormal=$alt;}
			if($altNormal>490){
			//si l'alt es més gran:
			$altMax = 490;
			$factor = $altNormal/$altMax;
			$ampleNormal= $ampleNormal/$factor;
			$altNormal = $altMax;
			}
		}else{$altNormal = $alt;$ampleNormal = $ample;}
		
		$novaImatgeN = imagecreatetruecolor($ampleNormal,$altNormal);
		imagecopyresampled($novaImatgeN,$imatgeJPG,0,0,0,0,$ampleNormal,$altNormal,$ample,$alt);
		imagejpeg($novaImatgeN,$desti);
		imagedestroy($novaImatgeN);
		imagedestroy($imatgeJPG);
		$imatgeJPG = imagecreatefromjpeg($desti);
		$imatgeNormal = imagecreatetruecolor(950,490);
		//mirem el ample i el alt per reduir-la
		$ample=imagesx($imatgeJPG);
		$alt=imagesy($imatgeJPG);
		$iniXN=(950/2)-($ample/2);
		$iniYN=(490/2)-($alt/2);
		imagecopyresampled($imatgeNormal,$imatgeJPG,$iniXN,$iniYN,0,0,$ampleNormal,$altNormal,$ample,$alt);
		imagedestroy($imatgeJPG);
		imagejpeg($imatgeNormal,$desti);
		imagedestroy($imatgeNormal);
		$info_cat = "<span class='tit_not tit_cat'>$tit_cat</span><span class='info_not_cat'>$text_cat<p class='imatge'><img id='img$noti' src='$destimin'></img><input type='hidden' id='url_img$noti' value='$desti'></input></p></span>";
		$info_cas = "<span class='tit_not tit_cas'>$tit_cas</span><span class='info_not_cas'>$text_cas<p class='imatge'><img id='img$noti' src='../$destimin'></img><input type='hidden' id='url_img$noti' value='/$desti'></input></p></span>";
		$info_ang = "<span class='tit_not tit_ang'>$tit_ang</span><span class='info_not_ang'>$text_ang<p class='imatge'><img id='img$noti' src='../$destimin'></img><input type='hidden' id='url_img$noti' value='../$desti'></input></p></span>";
		break;
		
		case "video":
		$imatgerebuda= $_FILES["imatge"]["tmp_name"];
		$nomfoto=str_replace(" ","_",$tit_cat);
		$desti="../img/mini/".$nomfoto.".jpg";
		move_uploaded_file ($imatgerebuda,$desti);
		//creant la imatge normal i la miniatura
		$imatgeJPG = imagecreatefromjpeg($desti);
		//mirem el ample i el alt per reduir-la 336 189
		$ample=imagesx($imatgeJPG);
		$alt=imagesy($imatgeJPG);
		if($ample>336||$alt>189){
			if($ample>336){
			//si l'ample es més gran:
			$ampleMax = 336;
			$factor = $ample/$ampleMax;
			$altMini= $alt/$factor;
			$ampleMini=$ampleMax;
			}else{$ampleMini=$ample;$altMini=$alt;}
			if($altMini>189){
			//si l'alt es més gran:
			$altMax = 189;
			$factor = $altMini/$altMax;
			$ampleMini= $ampleMini/$factor;
			$altMini = $altMax;
			}
		}else{$altMini = $alt;$ampleMini = $ample;}
		$novaImatge = imagecreatetruecolor($ampleMini,$altMini);
		imagecopyresampled($novaImatge,$imatgeJPG,0,0,0,0,$ampleMini,$altMini,$ample,$alt);
		$destimin="../img/mini/".$nomfoto.".jpg";
		imagejpeg($novaImatge,$destimin);
		imagedestroy($novaImatge);
		imagedestroy($imatgeJPG);
		$vid_enllac=$_POST["en_video"];
			$info_cat = "<span class='tit_not tit_cat'>$tit_cat</span><span class='info_not_cat'>$text_cat<p class='video'><img id='img$noti' src='$desti'></img><input type='hidden' id='url_img$noti' value='$vid_enllac'></input></p></span>";
			$info_cas = "<span class='tit_not tit_cas'>$tit_cas</span><span class='info_not_cas'>$text_cas<p class='video'><img id='img$noti' src='../$desti'></img><input type='hidden' id='url_img$noti' value='$vid_enllac'></input></p></span>";
			$info_ang = "<span class='tit_not tit_ang'>$tit_ang</span><span class='info_not_ang'>$text_ang<p class='video'><img id='img$noti' src='../$desti'></img><input type='hidden' id='url_img$noti' value='$vid_enllac'></input></p></span>";
		break;
	}
		echo($tit_cat."<br>".$tit_cas."<br>".$tit_ang."<br>".$info_cat."<br>".$info_cas."<br>".$info_ang."<br>".$tipus);
?>
		<form id="enviar_multi" method="post" action="crea_noticia.php">
			<input type="text" name="c_tit_cat" value="<?php echo($tit_cat)?>"></input><br>
			<input type="text" name="c_info_cat" value="<?php echo($info_cat)?>"></input>
			<input type="text" name="c_tit_cas" value="<?php echo($tit_cas)?>"></input><br>
			<input type="text" name="c_info_cas" value="<?php echo($info_cas)?>"></input>
			<input type="text" name="c_tit_ang" value="<?php echo($tit_ang)?>"></input><br>
			<input type="text" name="c_info_ang" value="<?php echo($info_ang)?>"></input>
			<input type="text" name="tipus" value="multimedia"></input>
			<button type="submit">enviar</button>
		</form>
</body>
</html> 

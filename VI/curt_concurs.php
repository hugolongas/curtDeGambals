<?php
	require("conecta_sql.php");
	$votacions="";
	$ip_usuari =$_SERVER['REMOTE_ADDR'];
	$usuario = base64_encode($ip_usuari);
	//conectem a la base de dades de control de vots per comprovar si ha votat
	$consulta = "SELECT * FROM control_vots WHERE ip_ordinador LIKE '$usuario' ORDER BY dia_vot ASC;";
	if(!$usuari = $mysqli ->query($consulta)){			die('There was an error running the query: '.$usuari.' [' . $mysqli->error . ']');		}
	$registre = mysql_num_rows($usuari);	$registre = $usuari->num_rows;
	if($registre > 0){		$row = $usuari -> fetch_assoc();		
		$votacions= $row["curts_votats"];
		$diavotacio=$row["dia_vot"];
		$diavotacio = str_replace("-","",$diavotacio);
		$ara = date("Y-m-d");
		$ara = str_replace("-","",$ara);
		if($diavotacio<$ara){
			$votacions ="";
		}
	}
	$titol_curt = "";
	$director_curt="";
	if(isset($_POST["titol_curt"])){$titol_curt = $_POST["titol_curt"];}
	if(isset($_POST["director_curt"])){$director_curt = $_POST["director_curt"];}
	$consulta = "SELECT * FROM concurs WHERE (titol LIKE '%".$titol_curt."%' && director LIKE '%".$director_curt."%') ORDER BY titol ASC;";		if(!$concurs = $mysqli ->query($consulta)){			die('There was an error running the query: '.$concurs.' [' . $mysqli->error . ']');		}
		$totalConcurs = $concurs->num_rows;
	if($votacions==""){
		for($i=0;$i<$totalConcurs;$i++){
			if($i<$totalConcurs-1){
			$votacions .="0|";
			}else{
			$votacions .="0";
			}
		}
	}
	$votat=explode("|",$votacions);
	$pag=1;
	$curts=8;
	$obert=0;
	?>
	<?php for($i=0;$i<$totalConcurs;$i++){		$row = $concurs -> fetch_assoc();
		$titol = $row['titol'];
		$director = $row['director'];
		$any = $row['any'];
	$sinopsis = $row['sinopsis_cat'];
		$enll = $row['enll'];
		$vots = $row['vots'];
		$id = $row['id'];
	?>
	<?php if($i%$curts==0){?>
	<div id="pag<?php echo $pag;?>" class="pag">
	<?php $obert=1;$pag++;}?>
	
			<div id="curt<?php echo $i; ?>" class='curt <?php if($votat[$id-1]=="1"){echo " votat";} ?>'>
				<span class="titol_curt"><?php echo $titol; 	echo($id_usuari);?></span>
				<span class="director_curt"><?php echo $director; ?></span>
				<img class="imag" src="img/play.png" rel="<?php echo $enll; ?>"></img>
				<span class="vots">vots: <?php echo $vots ?></span>
				<input type="hidden" class="sinop" value="<?php echo $sinopsis; ?>"></input>
				<input type="hidden" class="any" value="<?php echo $any; ?>"></input>
				<input type="hidden" class="id" value="<?php echo $id; ?>"></input>
			</div>
	<?php if($i+1==$curts*($pag-1)) {?></div><?php $obert=0;}?>
		<?php }	?>
	<?php if($obert==1) {echo("</div>");$obert=0;}?>
	<script>
		$(".curt").click(function(){
			curt = this.id;
			//obtenim les dades
			titol = $("#"+curt+" > .titol_curt").html();
			director = $("#"+curt+" > .director_curt").html();
			any = $("#"+curt+" > .any").val();
			sinop = $("#"+curt+" > .sinop").val();
			enll=$("#"+curt+" > img").attr("rel");
			inicio = enll.indexOf("://")+3;
			fin  = enll.length;
			enlace = enll.substring(inicio,fin);
			if(enlace.indexOf("vimeo")>-1){
				enll = "//" + enlace.replace("vimeo.com","player.vimeo.com/video");
			}
			if(enlace.indexOf("youtube")>-1){
				enll = "//" + enlace.replace("watch?v=","embed/");
			}
			if(enlace.indexOf("festival.movibeta")>-1){
				enll = "movibeta.php?enll="+enll.replace("&","@");;
			}
			id = $("#"+curt+" > .id").val();
			
			$("#titol", window.parent.document).html(titol);
			$("#reproductor_curt", window.parent.document).attr("src",enll);
			$("#director", window.parent.document).html(director);
			$("#any", window.parent.document).html(any);
			$("#sinopsis", window.parent.document).html(sinop);
			if(!$("#"+curt).hasClass("votat")){
				$("#votacio", window.parent.document).html("<button id='votar' class='votar' value='"+id+"'>votar</button>");
			}else{
				$("#votacio", window.parent.document).html("<span class='novotar'>Ja has votat aquest curt avui, torna en 24h</span>");
			}
			$("#votacio", window.parent.document).html("<span class='novotar'>Ja ha finalitzat el concurs web gracies a tots per participar.</span>");
			$('#fons_reproductors', window.parent.document).show();
		});
	</script>	
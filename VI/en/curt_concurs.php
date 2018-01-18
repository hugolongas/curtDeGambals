<?php
	require("conecta_sql.php");
	$votacions="";
	$ip_usuari =$_SERVER['REMOTE_ADDR'];
	$usuario = base64_encode($ip_usuari);
	//conectem a la base de dades de control de vots per comprovar si ha votat
	$conexio = "SELECT * FROM control_vots WHERE ip_ordinador LIKE '$usuario' ORDER BY dia_vot ASC;";
	$usuari = mysql_query($conexio,$conectat);
	$registre = mysql_num_rows($usuari);
	if($registre > 0){
		$votacions= mysql_result($usuari,$registre-1,"curts_votats");
		$diavotacio=mysql_result($usuari,$registre-1,"dia_vot");
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
	$consulta = "SELECT * FROM concurs WHERE (titol LIKE '%".$titol_curt."%' && director LIKE '%".$director_curt."%') ORDER BY titol ASC;";
	$concurs = mysql_query($consulta,$conectat);
	$totalConcurs = mysql_num_rows($concurs);
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
	<?php for($i=0;$i<$totalConcurs;$i++){
		$titol = mysql_result($concurs,$i,'titol');
		$director = mysql_result($concurs,$i,'director');
		$any = mysql_result($concurs,$i,'any');
		$sinopsis = mysql_result($concurs,$i,'sinopsis_eng');
		$enll = mysql_result($concurs,$i,'enll');
		$vots = mysql_result($concurs,$i,'vots');
		$id = mysql_result($concurs,$i,'id');
	?>
	<?php if($i%$curts==0){?>
	<div id="pag<?php echo $pag;?>" class="pag">
	<?php $obert=1;$pag++;}?>
	
			<div id="curt<?php echo $i; ?>" class='curt <?php if($votat[$id-1]=="1"){echo " votat";} ?>'>
				<span class="titol_curt"><?php echo $titol; ?></span>
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
				enll ="//"+ enlace.replace("vimeo.com","player.vimeo.com/video");
			}
			if(enlace.indexOf("youtube")>-1){
				enll ="//"+ enlace.replace("watch?v=","embed/");
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
				$("#votacio", window.parent.document).html("<button id='votar' class='votar' value='"+id+"'>vote</button>");
			}else{
				$("#votacio", window.parent.document).html("<span class='novotar'>You already voted this short today, back in 24h</span>");
			}
			$("#votacio", window.parent.document).html("<span class='novotar'>The web competition has ended, thank you all for participating</span>");
			$('#fons_reproductors', window.parent.document).show();
		});
	</script>
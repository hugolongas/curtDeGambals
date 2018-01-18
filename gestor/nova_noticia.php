<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - crear noticia</title>
<meta charset="UTF-8">
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<style type="text/css">
body{
	width:900px;
	height:500px;
}
.desap{
	display:none;
}
.form_crea{
	float:left;
	width:250px;
	height:430px;
	padding:5px;
	margin-left:5px;
	text-align:justify;
	border:1px solid black;
}
.v_previa{
	float:left;
	width:336px;
	height:460px;
	padding:5px;
	text-align:justify;
	border:1px solid black;
	background-color:white;
}
.tit_not{
	display:block;
	font-size:20px;
	margin-top:5px;
	margin-bottom:10px;
}
#menu{
	height:20px;
}
.bot{
	width:100px;
	height:20px;
	float:left;
}
#crea_noti{
	position:absolute;
	width:900px;
	height:430px;
	background-color:white;
}
#envia_noti{
	position:absolute;
	top:700px;
	background-color:white;
}
#vista_previa{
	display:none;
	position:absolute;
	left:60px;
	top:70px;
	width:1012px;
	border:1px solid red;
}
#fons{
	display:none;
	position:absolute;
	left:0px;
	top:0px;
	background-color:rgba(0,0,0,0.8);
	width:100%;
	height:100%;
}
</style>
<script>
$(document).ready(function(){
	/*Variables generals*/
	idio = ["cat","cas","ang"];
	primer = "text";
	/*selector de opcio*/
	$(".bot").click(function(e){
	if(e.target.id!=primer){
		$("#cont_"+e.target.id).removeClass("desap");
		$("#cont_"+primer).addClass("desap");
		primer=e.target.id;
		}
		});
		//nova noticia de text
	$("#previa").click(function(){
		/*variables locales*/
		for(j=0;j<idio.length;j++){
			fin_info="";
			/*paso el titulo*/
			tit_not = $("#pre_tit_"+idio[j]).val();
			$(".tit_"+idio[j]).html(tit_not);
			/*paso la info*/
			info_not = $("#pre_info_"+idio[j]).val();
			for(i=0;i<info_not.length;i++){
				cual = info_not.charCodeAt(i);
				if(cual==10){
					cara = "<br>";
				}else{
					cara = String.fromCharCode(cual);
				}
				fin_info+=cara;
			}
			/*copio a vista previa*/
			$(".info_not_"+idio[j]).html(fin_info);
			titol=$(".tit_"+idio[j]).html();
			/*copio la vista previa al formulari per enviar-ho*/
			informa=$(".v_previa_"+idio[j]).html();
			$(".envia_tit_"+idio[j]).val(titol);
			$(".envia_noticia_"+idio[j]).val(informa);
			$("#enviar_text").submit();
		}
		});	
});

</script>
</head>
<body>
<h2>Nova noticia</h2>
<div id="menu">
 <div class="bot" id="text">Informació</div>
 <div class="bot" id="foto">Imatge</div>
 <div class="bot" id="galeria">Galeria</div>
</div>
<div id="cont_text">
	<div id="crea_noti">
		<div class="form_crea">
			CATALA:<br>
				titol<br>
				<input id="pre_tit_cat" type="text"></input><br>
				info<br>
				<textarea id="pre_info_cat" cols="25" rows="18" ></textarea>
		</div>
		<div class="form_crea">
			CASTELLA:<br>
				titol<br>
				<input id="pre_tit_cas" type="text"></input><br>
				info<br>
				<textarea id="pre_info_cas" cols="25" rows="18" ></textarea>
		</div>
		<div class="form_crea">
			ANGLES:<br>
				titol<br>
				<input id="pre_tit_ang" type="text"></input><br>
				info<br>
				<textarea id="pre_info_ang" cols="25" rows="18" ></textarea>
		</div>
		<form id="enviar_text" method="post" action="crea_noticia.php">
			<input type="text" name="c_tit_cat" class="envia_tit_cat"></input><br>
			<input type="text" name="c_info_cat" class="envia_noticia_cat"></input>
			<input type="text" name="c_tit_cas" class="envia_tit_cas"></input><br>
			<input type="text" name="c_info_cas" class="envia_noticia_cas"></input>
			<input type="text" name="c_tit_ang" class="envia_tit_ang"></input><br>
			<input type="text" name="c_info_ang" class="envia_noticia_ang"></input>
			<input type="text" name="tipus" value="text"></input>
		</form>
		<button id="previa">Guardar</button>
	</div>
	<div id="vista_previa">
		<div class="v_previa v_previa_cat">
			<span class="tit_not tit_cat"></span>
			<span class="info_not_cat"></span>
		</div>
		<div class="v_previa v_previa_cas">
			<span class="tit_not tit_cas"></span>
			<span class="info_not_cas"></span>
		</div>
		<div class="v_previa v_previa_ang">
			<span class="tit_not tit_ang"></span>
			<span class="info_not_ang"></span>
		</div>
	</div>
</div>

<div id="cont_foto" class="desap">
		<form id="envia_img" method="post" enctype="multipart/form-data" action="crea_multi.php">
		<fieldset>
			<legend>Titols</legend>
		<label>Català:<input type="text" name="tit_img_cat"></input></label>
		<label>Castellà:<input type="text" name="tit_img_cas"></input></label>
		<label>Anglès:<input type="text" name="tit_img_ang"></input></label>
		</fieldset>
		<fieldset>
			<legend>Info:</legend>
		<label>Català:<input type="text" name="info_img_cat"></input></label>
		<label>Castellà:<input type="text" name="info_img_cas"></input></label>
		<label>Anglès:<input type="text" name="info_img_ang"></input></label>
		</fieldset>
		<fieldset>
			<legend>tipus</legend>
		<input type="radio" name="imgovid" value="imatge" REQUIRED>imatge</input><br>
		<input type="radio" name="imgovid" value="video"  REQUIRED>videos</input><br>
		</fieldset>
		<fieldset>
			<legend>multimedia</legend>
			<input type="file" name="imatge"></input><br>
			<label>enllaç:<input type="text" name="en_video">Important, l'enllaç ha de ser:http://www.youtube.com/embed/XXXXXX</input></label>
		</fieldset>
		<input type="hidden" name="tipus" value="multimedia"></input>
		<button type="submit" id="guardar_img">guardar</button>
		</form>
<div id="cont_galeria"  class="desap">
	Facebook
</div>
</body>
</html> 
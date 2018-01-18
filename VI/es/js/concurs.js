$("document").ready(function(){
pagIni="iraPag1";
	$(".buscar").click(function(){
		titol = $("#titol_curt").val();
		director = $("#director_curt").val();
		dataset= "titol_curt="+titol+"&director_curt="+director;
		$.ajax({
                data:  dataset,
                url:   'curt_concurs.php',
               type:  'post',
                beforeSend: function () {
                        $("#curts").html("Buscan...");
                },
                success:  function (response) {
                        $("#curts").html(response);
						paginas();
                }
		});
	});
	
	$("#moqueta_curts").ready(function(){
		paginas();
		tamany();
	});
	
	function tamany(){
		total=$(".pag").size();
		ancho = 1000*total;
	  $("#moqueta_curts").css("width",ancho+"px");
	}
	
	function paginas(){
		$("#paginas").html("");
		total=$(".pag").size();
		if(total>1){
		for(i=1;i<=total;i++){
			anterior = $("#paginas").html();
			clases="iraPag";
			if(i==1){clases="iraPag activa";}
			nuevo = anterior+"<div class='"+clases+"' id='iraPag"+i+"'>"+i+"</div>";
			$("#paginas").html(nuevo);
		 }
		 ancho = 25*total;
		 
		 $("#paginas").css("width",ancho+"px");
		}
	}
	
	$("#paginas").on('click','.iraPag',function(){
	 id=this.id;
	 if(id!=pagIni){
	 pag=id.replace("iraPag","");
	 pag=parseInt(pag);
	 margen=-1000*(pag-1);
	 $("#moqueta_curts").css("marginLeft",margen+"px");
	 $("#"+pagIni).removeClass("activa");
	 $("#"+id).addClass("activa");
	 pagIni=id;
	 }
	 });
	 
});
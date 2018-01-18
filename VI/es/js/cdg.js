primer="inici";
prim_rot="pasa_por";
ocult=true;
$(document).ready(function(){

	$(".boto").click(function(event){
		aquest=event.target.id;
		dis_cont=document.getElementById("cont_"+aquest).offsetLeft;
		dis_men=document.getElementById("men_"+aquest).offsetLeft;
		dis_fons=$("#fons_menu").css("left");
		if(dis_cont!=dis_fons){
		$("#fons_menu").animate({left:-dis_men+"px"},2000);
		$("#moqueta").animate({left:-dis_cont+"px"},2000);
		}
	});
  
	$(".boto").click(function(event){
		aquest=event.target.id;
		if(aquest!=primer){
		$("#"+aquest).addClass("boto_seleccionat");
		$("#"+primer).removeClass("boto_seleccionat");
		primer=aquest;
		}
	});
		
	$(".bot_pasa").click(function(event){
		aquest=event.target.id;
			$("#vis_"+prim_rot).slideUp(1000,
				function(){
				$("#vis_"+aquest).slideDown(1000);
				});
			
			prim_rot=aquest;
	});
	$("#tanca_curt").click(function(){
		$("#fons_reproductors").hide();
		$("#reproductor_curt").attr("src","");
	});
	
	//votacions
	$("#votacio").on("click",".votar", function(){
		vot = $("#votar").val();
		dataset = "vot="+vot;
		$.ajax({
                data:  dataset,
                url:   'votacions.php',
               type:  'post',
                
                success:  function (/*response*/) {
						//$("#votacio").html(response);
						$("#visu_con")[0].contentWindow.location.reload(true);
						$("#fons_reproductors").hide();
						$("#reproductor_curt").attr("src","");
                }
		});
	});
});
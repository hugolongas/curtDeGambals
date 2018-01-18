$(document).ready(function(){
	ini = 0;
	dis = 470;
	fin = 0;
	cont = 0;
	$("#n_seg").click(function(){
	 if(cont==0){
		fin = $("#fi").val();
		cont = 0;
		}
		if(ini!=fin){
			ves = ini+dis;
			$("#visu_noticies").contents().find("#moqueta_noti").css("top",-ves+"px");
			ini = ves;
		}
	});
		
	$("#n_ant").click(function(){
		if(ini!=0){
			ves = ini-dis;
			$("#visu_noticies").contents().find("#moqueta_noti").css("top",-ves+"px");
			ini = ves;
			}
	});
});
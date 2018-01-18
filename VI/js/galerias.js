$(document).ready(function(){
	$(".video").click(function(event){
		quin=event.target.id;
		url=$("#url_"+quin).val();
		$("#fons_negre", window.parent.document).show();
		$("#visor", window.parent.document).animate({width:"2px",height:"560px"},"slow");
		$("#visor", window.parent.document).animate({width:"1000px"},"slow");
		$("#visor_videos", window.parent.document).show();
		$("#v_video", window.parent.document).attr('src',url);
	});
	$(".imatge").click(function(event){
		quin=event.target.id;
		url=$("#url_"+quin).val();
		$("#fons_negre", window.parent.document).show();
		$("#visor", window.parent.document).animate({width:"2px",height:"560px"},"slow");
		$("#visor", window.parent.document).animate({width:"1000px"},"slow");
		$("#visor_imatges", window.parent.document).show();
		$("#v_imatges", window.parent.document).attr('src',url);
	});
	$("#close", window.parent.document).click(function(){
		$("#fons_negre", window.parent.document).hide();
		$("#visor_videos", window.parent.document).hide();
		$("#visor_imatges", window.parent.document).hide();
		$("#visor", window.parent.document).animate({width:"0px",height:"0px"});
	});
});
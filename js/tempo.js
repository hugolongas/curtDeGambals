var estrena = new Date (2017,11,1,0,0,0);
$(document).ready(function(){
	tempo();
	});
	function tempo(){
	var avui = new Date();
	var falten = estrena - avui;
	if (falten > 0){
	var segons = Math.round(falten/1000);
	var minuts = Math.floor(segons/60);
	var hores = Math.floor(minuts/60);
	var dies_f = Math.floor(hores/24);
	var segons_f = segons%60;
	var minuts_f = minuts%60;
	var hores_f = hores%24;
	document.getElementById("dies").innerHTML = dies_f;
	document.getElementById("hor").innerHTML = hores_f;
	document.getElementById("min").innerHTML = minuts_f;
	document.getElementById("seg").innerHTML = segons_f;
	setTimeout("tempo()",1000);
	}
	else {
	document.getElementById("dies").innerHTML = "0";
	document.getElementById("hor").innerHTML = "0";
	document.getElementById("min").innerHTML = "0";
	document.getElementById("seg").innerHTML = "0";
	}
	}
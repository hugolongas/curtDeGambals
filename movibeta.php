<?php 
if(!isset($_GET["enll"])){
	$enll="";
}
else{
$enll=$_GET["enll"];
$enll = str_replace("@","&",$enll);
}?>
<!DOCTYPE html>
<head>
<script src="http://festival.movibeta.com/web/views/js/flowplayer-3.2.12.min.js" type="text/javascript" charset="utf-8"></script>
<script src="http://festival.movibeta.com/web/views/js/flowplayer.ipad-3.2.12.js" type="text/javascript" charset="utf-8"></script>
</head>
<body style="margin:0px;width:630px;height:350px;">
	<div class="video-js-box" id="vid">
    	<a href="<?php echo($enll); ?>" style="display:block;width:630px;height:350px" id="player"></a>
		<script type="text/javascript">
		var currentcaption = "",
  	player = flowplayer("player", "http://festival.movibeta.com/web/views/flash/flowplayer-3.2.16.swf",{
  	    clip:{
			autoPlay: false,
  	        autoBuffering: true,
  	      	scaling: 'fit',
  			captionUrl: ''
  	    },
  	    plugins:{
  	        captions:{
  	            url: "http://festival.movibeta.com/web/views/flash/flowplayer.captions-3.2.9.swf",
  	            captionTarget: 'content',
  	            button:null
  	        },
  	        content:{
  	            url: "http://festival.movibeta.com/web/views/flash/flowplayer.content-3.2.8.swf",
  	            bottom: 25,
  	            height:40,
  	            backgroundColor: 'transparent',
  	            backgroundGradient: 'none',
  	            border: 0,
  	            textDecoration: 'outline',
  	            style: {
  	                body: {
  	                    fontSize: 14,
  	                    fontFamily: 'Arial',
  	                    textAlign: 'center',
  	                    color: '#ffffff'
  	                }
  	            }
  	        },
  	        controls: {
  	            url: "http://festival.movibeta.com/web/views/flash/flowplayer.controls-3.2.15.swf",
  	            autoHide: {
  	                hideDelay: 1500
  	            }
  	        }
  	    },
  	    canvas: {
  	    	background: 'url(http://festival.movibeta.com/web/views/images/splash_player_logo.png) no-repeat 280 285',
  	        backgroundGradient: 'none'
  	    }
  	}).ipad({validExtensions:null});
  	
  	if(document.getElementById('select_captions')!=null){
  	  document.getElementById('select_captions').onchange = function () {
  	  	if(document.getElementById('select_captions').value!='')
        	currentcaption = 'http://festival.movibeta.com/web/views/cc/'+document.getElementById('select_captions').value;
        else
        	currentcaption = 'http://festival.movibeta.com/web/views/cc/null_cc.srt';
        player.getPlugin("captions").loadCaptions(0, currentcaption);
      };
  	}
  	var isiDevice = /iPad|iPhone|iPod/i.test(navigator.userAgent);
  	if(isiDevice) document.getElementById('ccdiv').style.display = 'none';
		</script>
	</div>
</body>

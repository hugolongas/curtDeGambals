<?php
	$conectat=@mysql_connect("localhost","gambals","gamba92alianca");
	mysql_select_db("curtdegambals",$conectat);
	mysql_query("SET NAMES 'utf8'"); 
?>

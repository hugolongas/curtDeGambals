<!DOCTYPE html>
<html>
<head>
<TITLE>Curt de Gambals - concurs</title>
<meta charset="UTF-8">
<script>
</script>
</head>
<body>
<h1>CONCURS</h1>
<?php 
	require("conecta_sql.php");
	$consulta = "SELECT * FROM curts WHERE concurs_web='1' ORDER BY titol ASC;";	
	if(!$result = $mysqli ->query($consulta)){
			die('There was an error running the query: '.$result.' [' . $mysqli->error . ']');
		}
	$totalConcurs = $result->num_rows;
	
	echo($totalConcurs);
	?>
	<div id="concurs">
		<table>
			<tr>
				<td>Titol</td>
				<td>Any</td>
				<td>Director</td>
				<td>Enllaç</td>
				<td>Modificar</td>
			</tr>
		<?php
		$i = 1;
			while($row = $result -> fetch_assoc())
			{		
				$id = $row["id"];
				$titol = $row["titol"];
				$any = $row["any"];
				$director = $row["director"];
				$enll = $row["enll"];
		?>
		<tr>
			<td><?php echo $titol;?></td>
			<td><?php echo $any;?></td>
			<td><?php echo $director;?></td>
			<td><?php echo $enll;?></td>
			<td><a href="modifica_con.php?id=<?php echo $i;?>" target="_blank"></a></td>
		</tr>		
		<?php $i++;} ?>
		</table>
	</div>			
</body>
</html> 

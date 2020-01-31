<div id="name">
<h2>Скорость интернет соединения 
<?php 
	$date = new DateTime('-1 days');
	echo $date->format('Y-m-d');
?>
</h2>
</div>
<table id="keywords" >
<thead>
<tr>
	<th>Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ЦЕЛЬ</th>
	<th>СКОРОСТЬ</th>

</tr>
</thead>
<tbody>
<?php
	foreach($data as $row)
	{
		echo '<tr>
		<td>' .$row['idsession'].'</td>
		<td>' .$row['date'].'</td>
		<td>' .$row['time'].'</td>
		<td>' .$row['technology'].'</td>
		<td>' .$row['target'].'</td>
		<td>' .$row['speed'].'</td>
		</tr>';

	}

?>
</tbody>
</table>

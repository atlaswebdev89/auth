<div id="name">
<h2>Время отклика (пинг)
<?php 
	$date = new DateTime('-1 days');
	echo $date->format('Y-m-d');
?>
</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th>Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ПИНГ</th>
	<th>ЦЕЛЬ</th>
	<th>РАЗМЕР ПАКЕТА</th>

</tr>
</thead>
<tbody>
<?php
	foreach($data as $row)
	{
		echo '<tr>
		<td>' .$row['idsession'].'</td>
		<td>' .$row['date'].'</td>
		<td>' .$row['time_start'].'</td>
		<td>' .$row['technology'].'</td>
		<td>' .$row['ping_avg'].'</td>
		<td>' .$row['target'].'</td>
		<td>' .$row['bytes'].'</td>
		</tr>';

	}

?>
</tbody>
</table>
</div>

<div id="name">
<h2>Процент потери пакетов</h2>
</div>
<table id="keywords" >
<thead>
<tr>
	<th>Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ПИНГ</th>
	<th>ПОТЕРИ</th>

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
		<td>' .$row['packet_loss'].'</td>
		</tr>';

	}

?>
</tbody>
</table>


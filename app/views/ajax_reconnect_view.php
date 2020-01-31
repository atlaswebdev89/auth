<div id="name">
<h2>Разрывы связи</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th>Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ НАЧАЛА</th>
	<th>ВРЕМЯ ОКОНЧАНИЯ</th>
	<th>РАЗРЫВЫ СВЯЗИ</th>
	<th>IP АДРЕСС</th>
	<th>ТЕХНОЛОГИЯ</th>

</tr>
</thead>
<tbody>
<?php
	foreach($data as $row)
	{
		echo '<tr>
		<td>' .$row['idsession'].'</td>
		<td>' .$row['date'].'</td>
		<td>' .$row['time_in'].'</td>
		<td>' .$row['time_out'].'</td>
		<td>' .$row['reconnect'].'</td>
		<td>' .long2ip($row['ip']).'</td>
		<td>' .$row['technology'].'</td>
		</tr>';

	}

?>
</tbody>
</table>
</div>

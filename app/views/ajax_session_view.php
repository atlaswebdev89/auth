<script src="/js/sort.js"></script>
<div id="name">
<h2>Контрольные соединения</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th class="header">Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ НАЧАЛО</th>
	<th>ВРЕМЯ ОКОНЧАНИЯ</th>
	<th>ДЛИТЕЛЬНОСТЬ</th>
	<th>РАЗРЫВЫ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>IP АДРЕСС</th>

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
		<td>' .$row['time'].'</td>
		<td>' .$row['reconnect'].'</td>
		<td>' .$row['technology'].'</td>
		<td>' .long2ip($row['ip']).'</td>
		</tr>';

	}

?>
</tbody>
</table>
</div>

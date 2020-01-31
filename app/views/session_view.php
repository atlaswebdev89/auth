<div id="name">
<h2>Контрольные соединения ( сессии pppoe)
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
	<th>ID СЕССИИ</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ НАЧАЛА</th>
	<th>ВРЕМЯ ОКНОНЧАНИЯ</th>
	<th>ДЛИТЕЛЬНОСТЬ СЕССИИ</th>
	<th>РАЗРЫВЫ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ОШИБКИ</th>

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
		<td>' .$row['timediff(time_out, time_in)'].'</td>
		<td>' .$row['reconnect'].'</td>
		<td>' .$row['technology'].'</td>
		<td>' .$row['error'].'</td>
		</tr>';
	}

?>
</tbody>
</table>
</div>

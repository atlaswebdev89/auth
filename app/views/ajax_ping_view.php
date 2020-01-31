<script src="/js/sort.js"></script>

<div id="name">
<h2>Время отклика (пинг)</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th class="header">Сессия</th>
	<th>ДАТА</th>
	<th>ВРЕМЯ</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ЦЕЛЬ</th>
	<th>РАЗМЕР ПАКЕТА</th>
	<th>ПИНГ</th>

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
		<td>' .$row['target'].'</td>
		<td>' .$row['bytes'].'</td>
		<td>' .$row['ping_avg'].'</td>
		</tr>';

	}

?>
</tbody>
</table>
</div>

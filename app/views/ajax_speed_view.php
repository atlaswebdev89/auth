<div id="name">
<h2>Скорость получения данных</h2>
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
</div>
<script src=/js/sort.js></script>

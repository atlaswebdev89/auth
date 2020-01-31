<div id="name">

<h2>Сервер мониторинга  показателей качества доступа к сети интернет</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th>ЦЕЛЬ</th>
	<th>IP адресс</th>
	<th>ТЕСТ</th>
</tr>
</thead>
<tbody>
<?php
	foreach($data as $row)
	{
		echo '<tr>
		<td>' .$row['name'].'</td>
		<td>' .long2ip($row['ip_address']).'</td>
		<td>' .$row['test'].'</td>
		</tr>';

	}

?>
</tbody>
</table>
</div>

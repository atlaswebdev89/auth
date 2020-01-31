<div id="name">
<h2>Ошибки связи</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th>ДАТА</th>
	<th>ТЕХНОЛОГИЯ</th>
	<th>ОШИБКА</th>

</tr>
</thead>
<tbody>
<?php
	foreach($data as $row)
	{
		echo '<tr>
		<td>' .$row['date'].'</td>
		<td>' .$row['technology'].'</td>
		<td>' .$row['error'].'</td>
		</tr>';
	}
?>
</tbody>
</table>
</div>
<script src=/js/sort.js></script>

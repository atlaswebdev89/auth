<script src="/js/sort.js"></script>
<div id="name">
<h2>параметры сесиии</h2>
</div>
<div id="wrapper">

<?php

	foreach($data as $row)
	{
		echo "ID-session " .$row['idsession'].'<br />
		Количество ping тестов ' .$row['count(*)'].'<br />
		Среднее значение скорости ' .round(($row['speed']),2).' KB/s<br />
		Среднее значение пинга ' .$row['avg(ping_avg)'].' ms<br />';

	}

?>
</div>

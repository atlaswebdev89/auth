<script src="/js/sort.js"></script>
<div id="name">
<h2>Контрольные соединения</h2>
</div>
<div id="wrapper">
<table id="keywords" >
<thead>
<tr>
	<th>ДАТА</th>
        <th>ВРЕМЯ</th>
	<th>ДЛИТЕЛЬНОСТЬ</th>
	<th>Скорость,Kb/s</th>
        <th>ASBR,ms</th>
	<th>ASBRping кол-во</th>
        <th>ASBR норма</th>
        <th>PacketLosASBR норма</th>
        <th>DNS,ms</th>   
        <th>DNSping кол-во</th>
        <th>DNS норма</th>
        <th>PacketLosDNS норма</th>
</tr>
</thead>
<tbody>
    
<?php
        foreach($data as $row) 
            {
            echo '<tr>
		<td>' .$row['Date'].'</td>
		<td>' .$row['Time_in'].'</td>
		<td>' .$row['Time'].'</td>
		<td>' .round($row['Speed'], 2).'</td>
		<td>' .round($row['ASBR_PING'], 2).'</td>
		<td>' .$row['ASBR_NUM'].'</td>
                <td>' .$row['ASBR_NORMA'].'</td>
                <td>' .$row['PACKET_LOS_ASBR_NORMA'].'</td>
                <td>' .round($row['DNS_PING'], 2).'</td>
                <td>' .$row['DNS_NUM'].'</td>
                <td>' .$row['DNS_NORMA'].'</td>
                <td>' .$row['PACKET_LOS_DNS_NORMA'].'</td>
		</tr>';   
            }
?>
</tbody>
</table>
</div>

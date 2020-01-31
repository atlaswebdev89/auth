<?php
	$date=new DateTime('-1 days');
?>
<script src="/js/query-ajax.js"></script>
<div id="name">
<h2>Параметры подключения к сети</h2>
</div>

<div id="wrapper">
<form action="/query" method="post" id="ajaxform">
<p>
<label>Technology</label>
<select  name="technology" required>
						<option value="adsl" class="icon-tux">adsl</option>
						<option value="wll" class="icon-finder">wll</option>
						<option value="pon" class="icon-windows">pon</option>
						<option value="wifi" class="icon-android">wifi</option>
					</select>
</p>
<p>
<label>Target</label>
<select  name="stats" required>
						<option value="ping" class="icon-tux">ping</option>
						<option value="session" class="icon-finder">session</option>
						<option value="speed" class="icon-windows">speed</option>
						<option value="packetlos" class="icon-android">packetlos</option>
						<option value="reconnect" class="icon-android">reconnect</option>
						<option value="error" class="icon-android">error</option>
					</select>
</p>
<p>Выберите дату c : <input type="date" name="date_first" value="<?php echo $date->format("Y-m-d"); ?>"> по: <input type="date" name="date_last" value="<?php echo $date->format("Y-m-d"); ?>"></p>
<input id="load" type="button" value="Получить">
</form>
<img id="loadImg" src="/img/load2.gif" />
<div id="information"></div>
</div>

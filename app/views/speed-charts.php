<?php
	$date=new DateTime('-1 days');
?>
<div id="name">
<h2>Графики скорости доступа в интернет</h2>
</div>

<form >
<p>
<label>Технология</label>
<select  id="target" required>
						<option value="adsl" class="icon-tux">adsl</option>
						<option value="wll" class="icon-finder">wll</option>
						<option value="pon" class="icon-windows">pon</option>
						<option value="wifi" class="icon-android">wifi</option>
					</select>
</p>


<p>Выберите дату c : <input type="date" name="date_first" value="<?php echo $date->format("Y-m-d"); ?>"> по: <input type="date" name="date_last" value="<?php echo $date->format("Y-m-d"); ?>"></p>
<input id="load" type="submit" value="Получить">
</form>
<div id="information"></div>
<div id="wrapper"></div>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="/js/speed-charts.js"></script>

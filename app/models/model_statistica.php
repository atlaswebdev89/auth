<?php

namespace model;
use app\model;

class model_statistica extends model
{
	public function get_data()
	{
		$query='SELECT * FROM session ORDER BY `date` DESC ';
		$result=mysqli_query(self::$db_connection,$query);
		return $result;
	}

	public function get_data_los($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `pingstats` where packet_loss >0 ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `pingstats` where packet_loss >0';
				foreach($params as $key=>$value) 
				{
					$query=$query." and ".$key."=\"$value\"";
				}
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}

	public function get_data_session($params)
	{
		if (empty ($params))
		{
			$query='SELECT * , timediff(time_out, time_in)  FROM `session` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
//			echo $query;
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `session` where id>0  ';
				foreach($params as $key=>$value) 
				{
					$query=$query." and ".$key."=\"$value\"";
				}
				echo $query;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}

	public function get_data_speed($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `speedstats` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
//			echo $query;
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `speedstats` where id>0  ';
				foreach($params as $key=>$value) 
				{
					$query=$query." and ".$key."=\"$value\"";
				}
				echo $query;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}

	public function get_data_ping($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `pingstats` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
//			echo $query;
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `pingstats` where id>0  ';
				foreach($params as $key=>$value) 
				{
					$query=$query." and ".$key."=\"$value\"";
				}
				echo $query;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;
	}
}

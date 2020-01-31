<?php

namespace model;
use app\model;

class model_query extends model
{
	public function get_data_session($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `session` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT *, timediff(time_out, time_in) as time FROM `session` where technology="'.$params["technology"].'" and `date` >="'.$params["date_first"].'" and `date` <="'.$params["date_last"].'"' ;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;
	}

	public function get_data_session_info($params)
	{
		if (empty ($params))
		{
			$query='SELECT idsession, count(*), avg(ping_avg), (select avg(speed) from `speedstats` where idsession="'.$params["id_session"].'") as speed FROM `pingstats` where idsession="'.$params["id_session"].'"';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT idsession, count(*), avg(ping_avg), (select avg(speed) from `speedstats` where idsession="'.$params["id_session"].'") as speed FROM `pingstats`  where idsession="'.$params["id_session"].'"';
				$result=mysqli_query(self::$db_connection,$query);

			}
		return $result;
	}


	public function get_data_speed($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `speedstats` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `speedstats` where technology="'.$params["technology"].'" and `date` >="'.$params["date_first"].'" and `date` <="'.$params["date_last"].'"' ;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}

	
	public function get_data_ping($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `pingstats` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `pingstats` where technology="'.$params["technology"].'" and `date` >="'.$params["date_first"].'" and `date`<="'.$params["date_last"].'" ORDER BY `ping_avg` DESC';
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}
	
	
	public function get_data_reconnect($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `session` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `session` where `reconnect` > 0 and technology="'.$params["technology"].'" and `date` >="'.$params["date_first"].'" and `date` <="'.$params["date_last"].'"' ;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}
	
	public function get_data_error($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `session` where technology="'.$params["technology"].'" and date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `session` where technology="'.$params["technology"].'" and `error`>0 and `date` >="'.$params["date_first"].'" and `date` <="'.$params["date_last"].'"';
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}
	
	public function get_data_packetlos($params)
	{
		if (empty ($params))
		{
			$query='SELECT * FROM `session` where date=SUBDATE(CURDATE(), 1) ORDER BY `date` DESC';
			$result=mysqli_query(self::$db_connection,$query);
		}else
			{
				$query='SELECT * FROM `pingstats` where `packet_loss` > 0 and technology="'.$params["technology"].'" and `date` >="'.$params["date_first"].'" and `date` <="'.$params["date_last"].'"' ;
				$result=mysqli_query(self::$db_connection,$query);
			}
		return $result;

	}
}

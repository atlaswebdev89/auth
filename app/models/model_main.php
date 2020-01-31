<?php

namespace model;
use app\model;

class model_main extends model
{
	public function get_data()
	{
		$query='SELECT * FROM target';
		$result=mysqli_query(Model::$db_connection,$query);
		return $result;
	}

}

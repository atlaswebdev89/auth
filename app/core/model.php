<?php

namespace app;
use classes\databases;

class Model
    

{
        public $connect;
	//Создаем подключение к БД и передаем идентификатор во все дочерние классы для работы с БД
	protected static $db_connection = null;

	function __construct   ()
	{
		if (self::$db_connection == null )
			{
				self::$db_connection = databases::db();
			}
		return self::$db_connection;
	}

	public function get_data()
	{

	}
}

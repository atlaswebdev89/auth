<?php

namespace classes;
class databases {

	static function db () {

	/* Подключение к серверу MySQL */ 
	$link = mysqli_connect( 
           	 HOST,  /* Хост, к которому мы подключаемся */ 
           	 USER,       /* Имя пользователя */ 
           	 PASS,   /* Используемый пароль */ 
            	 BD);     /* База данных для запросов по умолчанию */ 

		if (!$link) 
		{ 
   			printf("Невозможно подключиться к базе данных. Код ошибки: %s\n", mysqli_connect_error()); 
   			exit; 
		}
	return  $link;
	}
}
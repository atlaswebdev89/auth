<?php
namespace app;
class route
{
	static function start()
	{

		// контроллер и действие по умолчанию
		$controller_name = 'main';
		$action_name = 'index';
		$params = array();

		$url_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		$routes = explode('/', trim($url_path, ' /'));

		// получаем имя контроллера
		if ( !empty($routes[0]) )
		{
			$controller_name = array_shift($routes);
		}

		// получаем имя экшена
		if ( !empty($routes[0]) and $controller_name != "query")
		{
			$action_name = array_shift($routes);
		}
		//Проверка GET параметров на кратность 2 Если количество частей не кратно 2, значит, в URL присутствует ошибка и такой URL 
		// обрабатывать не нужно - кидаем исключение, что бы назначить и действие,
		// отвечающие за показ 404 страницы.

		if (!empty($routes[0]) && count($routes) % 2)
			{
				route::ErrorPage404();
				exit;
			}
				elseif (!empty($routes[0])) {

			//Создание массива где индекс соответсвует названию параметра
					for ($i=0; $i < count($routes); $i++)
						{
							$params[$routes[$i]] = $routes[++$i];
						}
			}

		if (isset($_POST)) 
				{
					$params=$_POST;
					$_POST=array();
				//	print_r($params);
					if (!empty($params["target"])) 
					{
						$action_name=$params["target"];
					} 
						
			}

	//	echo "Controller=$controller_name" .'<br>';
	//	echo "action_name=$action_name".'<br>';

		// добавляем префиксы	
		if (!preg_match("#^[aA-zZ0-9\-_]+$#",$controller_name)) {
			route::ErrorPage404();
			exit;
		}

		$controller_name = '\\controller\\'.'controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
	
//		echo $controller_name.'<br>';
//		echo $action_name.'<br>';

		$controller = new $controller_name;
		$action = $action_name;

		if(method_exists($controller,  $action))
		{
			// вызываем действие контроллера
			$controller->$action($params);
		}
		else
		{
			// здесь также разумнее было бы кинуть исключение
			route::ErrorPage404();
		} 
	}
	function ErrorPage404()
	{
			$controller_name = '404';
			$action = 'action_index';
			$controller_name = '\\controller\\'.'controller_'.$controller_name;

			$controller = new $controller_name;

			if(method_exists($controller,  $action))
			{
				// вызываем действие контроллера
				$controller->$action();
			}
    }
}

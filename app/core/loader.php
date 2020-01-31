<?php

class loader 
{
	public function loadclass ($class)
	{
		$arr = explode ('\\', $class);
		$prefix = array_shift($arr);

		if ($prefix == 'app') {
			$prefix_file = '../app/core/';
		}
		elseif ($prefix == 'controller') {
			$prefix_file= '../app/controllers/';
		}
		elseif ($prefix == 'model') {
			$prefix_file='../app/models/';
		}
		elseif ($prefix == 'view') {
			$prefix_file='../app/views/';
		}

		elseif ($prefix == 'classes') {
			$prefix_file='../app/classes/';
		}

		$file=$prefix_file . implode('/', $arr).'.php';
//		echo $file.'<br>';
		if(is_file($file)) 
		{
			require_once $file;

		}else  {
			\app\route::ErrorPage404();
			exit;
		}
	}
}

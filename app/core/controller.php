<?php

namespace app;
use app\view;

class Controller {

	public $model;
	public $view;

	function __construct()
	{
		$this->view = new view();
	}

	// действие (action), вызываемое по умолчанию
	function action_index()
	{
		// todo	
	}
}

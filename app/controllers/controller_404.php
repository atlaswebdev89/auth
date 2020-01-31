<?php

namespace controller;
use app\controller;
use model\model_main;
use app\view;

class controller_404 extends controller
{

	function __construct () {
		$this->view = new view ();

	}
	function action_index()
	{	
		$this->view->generate('404_view.php', 'template_view.php');
	}
}

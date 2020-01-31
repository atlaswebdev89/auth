<?php

namespace controller;
use app\controller;
use model\model_main;
use app\view;

class controller_main extends controller
{

	function __construct () {
		$this->model = new model_main();
		$this->view = new view ();

	}
	function action_index()
	{	
		$data=$this->model->get_data();
		$this->view->generate('main_view.php', 'template_view.php', $data);
	}
}

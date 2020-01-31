<?php

namespace controller;

use app\controller;
use model\model_statistica;
use app\view;

class controller_statistica extends controller
{
	function __construct ()
	{
		$this->model = new model_statistica ();
		$this->view  = new view ();
	}

	function action_index()
	{

		$data=$this->model->get_data();
		$this->view->generate('session_view.php', 'template_view.php', $data);
	}


	function action_los($params)
	{

		$data=$this->model->get_data_los($params);
		$this->view->generate('packet_los_view.php', 'template_view.php', $data);
	}

	function action_session($params)
	{

		$data=$this->model->get_data_session($params);
		$this->view->generate('session_view.php', 'template_view.php', $data);
	}

	function action_speed($params)
	{

		$data=$this->model->get_data_speed($params);
		$this->view->generate('speed_view.php', 'template_view.php', $data);
	}
	
	function action_ping($params)
	{

		$data=$this->model->get_data_ping($params);
		$this->view->generate('ping_view.php', 'template_view.php', $data);
	}
	
}

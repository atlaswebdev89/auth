<?php

namespace controller;
use app\controller;
use model\model_quality;
use app\view;

class controller_quality extends controller
{

	function __construct () {
		$this->model = new model_quality();
		$this->view = new view ();
	}
	function action_index()
	{	
		$this->view->generate('quality_view.php', 'template_view.php');
	}

	function action_wll($params)
	{
		$data=$this->model->get_data_wll($params);
		$this->view->generate_html('ajax_quality_view.php', $data);
	}
	function action_pon($params)
	{
		$data=$this->model->get_data_pon($params);
		$this->view->generate_html('ajax_quality_view.php', $data);
	}
	function action_wifi($params)
	{
		$data=$this->model->get_data_wifi($params);
		$this->view->generate_html('ajax_quality_view.php', $data);
	}
	function action_adsl($params)
	{
		$data=$this->model->get_data_adsl($params);
		$this->view->generate_html('ajax_quality_view.php', $data);
	}
}

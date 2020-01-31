<?php

namespace controller;
use app\controller;
use model\model_query;
use app\view;

class controller_query extends controller
{

	function __construct () {
		$this->model = new model_query();
		$this->view = new view ();

	}
	function action_index()
	{	
		$this->view->generate('query_view.php', 'template_view.php');
	}

	function action_ping($params)
	{
		$data=$this->model->get_data_ping($params);
		$this->view->generate_html('ajax_ping_view.php', $data);
	}
	function action_session($params)
	{
		$data=$this->model->get_data_session($params);
		$this->view->generate_html('ajax_session_view.php', $data);
	}
	function action_reconnect($params)
	{
		$data=$this->model->get_data_reconnect($params);
		$this->view->generate_html('ajax_reconnect_view.php', $data);
	}
	function action_error($params)
	{
		$data=$this->model->get_data_error($params);
		$this->view->generate_html('ajax_error_view.php', $data);
	}
	function action_speed($params)
	{
		$data=$this->model->get_data_speed($params);
		$this->view->generate_html('ajax_speed_view.php', $data);
	}
	function action_packetlos($params)
	{
		$data=$this->model->get_data_packetlos($params);
		$this->view->generate_html('ajax_los_view.php', $data);
	}
	function action_session_info($params)
	{
		$data=$this->model->get_data_session_info($params);
		$this->view->generate_html('ajax_session_info_view.php', $data);
	}
}

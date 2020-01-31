<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace controller;
use app\controller;
use model\model_report;
use app\view;

class controller_report extends controller
{

	function __construct () {
		$this->model = new model_report();
		$this->view = new view ();

	}
	
        function action_index()
	{	
		$this->view->generate('report_view.php', 'template_view.php');
	}
        
        function action_adsl($params)
	{
		$data=$this->model->get_data_adsl($params);
		$this->view->generate_html('ajax_report_views.php', $data);
	}
        function action_wll($params)
	{
		$data=$this->model->get_data_wll($params);
		$this->view->generate_html('ajax_report_views.php', $data);
	}
        function action_pon($params)
	{
		$data=$this->model->get_data_pon($params);
		$this->view->generate_html('ajax_report_views.php', $data);
	}
        function action_wifi($params)
	{
		$data=$this->model->get_data_wifi($params);
		$this->view->generate_html('ajax_report_views.php', $data);
	}
}
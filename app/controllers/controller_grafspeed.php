<?php

namespace controller;
use app\controller;
use model\model_grafspeed;
use app\view;

class controller_grafspeed extends controller
{

	function __construct () {
		$this->model = new model_grafspeed();
		$this->view = new view ();
	}
	function action_index()
	{	  
		$this->view->generate('speed-charts.php','template_view.php');
	}
       
        function action_adsl($params)
	{	
		$data=$this->model->data_adsl($params);     
	}
        function action_wll($params)
	{	
		$data=$this->model->data_wll($params);     
	}
        function action_pon($params)
	{	
		$data=$this->model->data_pon($params);     
	}
        function action_wifi($params)
	{	
		$data=$this->model->data_wifi($params);     
	}
       
}

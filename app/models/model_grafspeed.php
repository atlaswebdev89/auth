<?php

namespace model;
use app\model;

class model_grafspeed extends model

{
    
    function __construct() {
        parent::__construct();
        $this->connect = Model::$db_connection;
    }

    
    private function speed_data ($data) {
         if(isset($data)) {
            if($data["target"]!=="pon") {
                    $speed='SELECT date, time, speed*8 as speed, (select (`speed_'.$data["target"].', KB/s`)*8 from quality) as speed_norma, (select speed_min from quality) as speed_min, (select speed_max from quality) as speed_max FROM `speedstats` where technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"';
            }else if ($data["target"]=="pon") {
                    $speed='SELECT date, time, speed*1024*8 as speed, (select (`speed_'.$data["target"].', KB/s`)*8 from quality) as speed_norma, (select speed_min from quality) as speed_min, (select speed_max from quality) as speed_max  FROM `speedstats` where technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"';	
            }
                    if($speed_res = mysqli_query($this->connect, $speed)){
                                    if($num_rows =  mysqli_num_rows($speed_res) !== 0){
                                        return $speed_res;
                                    }else die ("Нет сессий за указанный период!");
                    }else die ("Нет сессий за указанный период!");
         }
    }

    private function graf($data) {
             if(isset($data) && !empty($data)){
                 $speed=$this->speed_data($data);
 
                    $data2=array();
                    $data2["cols"]=array(
                     array(
                       "label"  =>  "дата",
                       "type"   =>  "string" 
                   ),array(
                       "label"  =>  "скорость",
                       "type"   =>  "number" 
                   ),array(
                       "label"  =>  "эталон",
                       "type"   =>  "number" 
                   )
             );
             foreach ($speed as $rows1) {      
                $q[]=array("c"=>array(
                     array("v"=>$rows1['date']." ".$rows1['time']),
                     array("v"=>$rows1['speed']),
                     array("v"=>$rows1['speed_norma']),
                        ),
                  );    
             }  
             $data2["rows"]=$q;
             return json_encode($data2);
             }
        }


        public function data_adsl($data)    
	{             
                     echo $data_out = $this->graf($data);             
	}
       public function data_wll($data)
	{  
                     echo $data_out = $this->graf($data);   
	}
        public function data_wifi($data)
	{  
                    echo $data_out = $this->graf($data);   
	}
        public function data_pon($data)
	{  
                   echo $data_out = $this->graf($data);   
	}

}

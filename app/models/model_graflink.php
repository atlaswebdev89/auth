<?php

namespace model;
use app\model;

class model_graflink extends model

{ 
    function __construct() {
        parent::__construct();
        $this->connect = Model::$db_connection;
    }

    //Количество установленных контрольных соединений
    private function session_data ($data) {   
        if(isset($data)) {           
            $query='SELECT * FROM `session` where error=0 and technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"'; 
            if($result=mysqli_query($this->connect,$query)) { 
                if($num_rows =  mysqli_num_rows($result) !== 0){
                    return $res=mysqli_num_rows($result);
                } else die ("Нет сессий за указанный период!");
            }else die ("Нет сессий за указанный период!");
        }
    }
    
    //Количество неустановленных сессий
    private function session_error ($data) {   
        if(isset($data)) {  
            $query='SELECT *  FROM `session` where error >0 and technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"'; 
            if($result=mysqli_query($this->connect,$query)) { 
                return $res=mysqli_num_rows($result);
            }else die ("Ошибка запроса");
        }else die ("пустой запрос");
    }

    private function graf($data) {
             if(isset($data) && !empty($data)){
                 $session   =  $this->session_data($data);
                 $error =    $this->session_error($data);
                  
                    $data2["cols"]=array(
                     array(
                       "label"  =>  "date",
                       "type"   =>  "string" 
                   ),array(
                       "label"  =>  "speed",
                       "type"   =>  "number" 
                   )
             );
                $data2["rows"][]=array (
                    "c"=>array(
                     array("v"=>"session"),
                     array("v"=>$session),
                        ),         
                   );  
                 $data2["rows"][]=array (
                    "c"=>array(
                     array("v"=>"error"),
                     array("v"=>$error),
                        ), 
                   );    
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

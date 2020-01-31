<?php

namespace model;
use app\model;

class model_quality extends model
{
    public $arr=array();
    
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
                    return $result;
                } else die ("Нет сессий за указанный период!");
            }else die ("Нет сессий за указанный период!");
        }
    }
    
    //Количество неустановленных сессий
    private function session_error ($data) {   
        if(isset($data)) {  
            $query='SELECT *  FROM `session` where error >0 and technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"'; 
            if($result=mysqli_query($this->connect,$query)) { 
                return $result=mysqli_num_rows($result);
            }else die ("Ошибка запроса");
        }else die ("пустой запрос");
    }
    
    //Средняя скорость подключения за весь период 
    private function speed_avg ($data){
        if(isset($data)) {
            if($data["target"]!=="pon") {
                    $speed='SELECT avg(speed) as speed_avg, (select `speed_'.$data["target"].', KB/s` from quality) as speed_norma, (select speed_min from quality) as speed_min, (select speed_max from quality) as speed_max FROM `speedstats` where technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"';
            }else if ($data["target"]=="pon") {
                    $speed='SELECT (avg(speed)*1024) as speed_avg, (select `speed_'.$data["target"].', KB/s` from quality) as speed_norma, (select speed_min from quality) as speed_min, (select speed_max from quality) as speed_max FROM `speedstats` where technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"';	
            }
                    if($speed_res = mysqli_query($this->connect, $speed)){
                                    while($row_speed=mysqli_fetch_array($speed_res)) 
                                            {
						$avg_speed = $row_speed["speed_avg"];
						$speed_norma = $row_speed["speed_norma"];
						$speed_min = $row_speed["speed_min"];
						$speed_max = $row_speed["speed_max"];
                                             }
					}else die ("Ошибка запроса");
				
				$Kspeed = round((($avg_speed/$speed_norma)*100), 2);
				$speed_norma = $speed_norma*8;
				$speed_avg = round($avg_speed, 2)*8;
                       return array (
                           'SPEED_AVG'       =>    $speed_avg , 
                           'Kspeed'          =>    $Kspeed,
                           'Pspeed_min'      =>    $speed_min,
                           'Pspeed_max'      =>    $speed_max,
                           'SPEED_NORMA'     =>    $speed_norma      
                                );
        }else die ("пустой запрос");
    }

    //Определение коэфициента готовности соединения с сетью
    private function status_network_time ($data){
        if(isset($data)) {
                $query='SELECT count(id) as count_con, sum(time_to_sec(timediff(time_out, time_in))/60) as AVG_TIME, (select Kgot from quality) as Kgot FROM `session` where error=0 and technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"';
		if($connection = mysqli_query($this->connect, $query)){		
				while($row_con=mysqli_fetch_array($connection)) 
                                        {
                                            $AVG_TIME= $row_con["AVG_TIME"];
                                            $list_con=$row_con["count_con"];
                                            $Pcon=$row_con["Kgot"];
                                        }          
				return round((($AVG_TIME)/($list_con*65)*100),2);
                }else die ("Ошибка запроса");
        }else die ("пустой запрос");
    }
    
    private function quality_status () {        
            $query='SELECT * FROM `quality`'; 
            if($result=mysqli_query($this->connect,$query)) { 
                if($num_rows =  mysqli_num_rows($result) !== 0){
                    return $result;
                } else die ("Нет сессий за указанный период!");
            }else die ("Нет сессий за указанный период!");
    }

    // Проверка каждого контрольнного соединения (сессии) на соответствие нормы по задержки ip пакетов
    private function delay_ip ($data) {
        $ping ='SELECT count(*) as count, (select Pdelay from quality) as Pdelay FROM `pingstats` where idsession = "'.$data.'" and ping_avg/2 > (select timedelay from quality)';
        if($ping_stats = mysqli_query($this->connect, $ping)) 
                {
                    while ($row_ping=mysqli_fetch_array($ping_stats)) 
                        {
                            if ($row_ping["count"] >0) 
                                {
                                    return "bad";
                                }                           
                        }
                }else die ("Ошибка запроса");   
    }
    

    // Проверка каждого контрольнного соединения (сессии) на соответствие нормы по  потерям
    private function los_ip ($data) {
        $los ='SELECT count(*) as count2, (select Plos from quality) as Plos FROM `pingstats` where idsession="'.$data.'" and  packet_loss > (select packet_los from quality) ';
        if($los_stats= mysqli_query($this->connect, $los))
                {
                    while ($row_los=mysqli_fetch_array($los_stats))
                    {
                        if ($row_los["count2"] > 0 )
                            {
                                   return "bad";
                            }
                    }
                }else die ("Ошибка запроса");   
    }
    
    // Проверка каждого контрольнного соединения (сессии) на соответствие нормы по скорости передачи
    private function speed_bad ($data, $technology) {
        if($technology == "pon"){
               $speed ='SELECT (avg(speed)*1024) as speed, (select `speed_'.$technology.', KB/s` from quality) as speed_'.$technology.', (select Pspeed from quality) as Pspeed, (select speed_min from quality) as speed_min  FROM `speedstats` where idsession="'.$data.'"';
            }else $speed ='SELECT avg(speed) as speed, (select `speed_'.$technology.', KB/s` from quality) as speed_'.$technology.', (select Pspeed from quality) as Pspeed, (select speed_min from quality) as speed_min  FROM `speedstats` where idsession="'.$data.'"';
	if($speed_stats= mysqli_query($this->connect, $speed)) 
                {
                    while ($row_speed=mysqli_fetch_array($speed_stats))
                    {                   
                        $Ps = ($row_speed["speed"])/($row_speed["speed_".$technology])*100;
                            if ($Ps < ($row_speed["speed_min"]) )
                                {
                                    return "bad";
                                }
                    }                       
                }else die ("Ошибка запроса");                  
           }		
    // Проверка каждого контрольнного соединения (сессии) на наличие разрыва связи       
    private function reconnect ($data){
        $reconnect ='SELECT count(*) as reconnect, (select Preconnect from quality) as Preconnect FROM `session` where idsession="'.$data.'" and  reconnect > 0 ';
        if($reconnect_stats= mysqli_query($this->connect, $reconnect))
                {
                    while ($row_recon=mysqli_fetch_array($reconnect_stats)) 
                            {
                                if ($row_recon["reconnect"] > 0 )
                                    {
                                        return "bad";
                                    }
                                }
                            }else die ("Ошибка запроса");  
    }

    //Добавление полученных данных для сессии в массив $arr
    private function add_to_array ($NUM_reconnect,$NUM_delay,$NUM_speed,$NUM_los,$SPEED_AVG,$Kspeed,$Pspeed_min, $SPEED_NORMA,$Num_ij,$Num_id, $Num_ih, $Num_iq, $Kd, $Klos,$Krecon,$Ks,$Qgot,$Qrecon,$Qdelay,$Qlos,$Qspeed, $session_error,$Num,$sumtime,$Kc,$Qcon) {
           
           $this->arr = array(
                            'num' => $Num,
                            'Num_Error' => $session_error,
                            'Kc' => $Kc,
                            'Qcon' => $Qcon,
                            'Kcon' => $sumtime,
                            'Pcon' => $Qgot,
                            'Krecon' => $Krecon,
                            'Precon' => $Qrecon,  
                            'Num_h' => $NUM_reconnect,
                            'Num_ih' => $Num_ih,
                            'Ks' => $Ks,
                            'Pspeed' =>$Qspeed,
                            'Num_q' => $NUM_speed,
                            'Num_iq' => $Num_iq,
                            'Kd' => $Kd,
                            'Pd' => $Qdelay,
                            'Num_j' => $NUM_delay,
                            'Num_ij' => $Num_ij,             
                            'Klos' => $Klos,
                            'Plos' => $Qlos,         
                            'Num_d' => $NUM_los,
                            'Num_id' => $Num_id,          
                            'Kspeed' => $Kspeed,
                            'Pspeed_min' => $Pspeed_min,         
                            'Pspeed_avg' => $SPEED_AVG,
                            'Pspeed_tp' => $SPEED_NORMA
                   );
    }
    
    #Функция формирует все данные для сессий и передает двумеррный масcив    
    private function quality ($data) {
      
      
        $NUM_delay = 0; //Количество соединений не удовлетворяющих нормам по задержкам
        $NUM_los = 0; //Количество соединений не удовлетворяющих нормам по потерям
        $NUM_speed = 0; //Количество соединений не удовлетворяющих нормам по скорости
        $NUM_reconnect = 0; //Количество соединений не удовлетворяющих нормам по разрывом соединения
        
        if(isset($data) && !empty($data)){
            $sessions=$this->session_data($data);
            //количество неустановленных сессии
            $session_error=$this->session_error($data);
            //Количество установленных сессий
            $Num= mysqli_num_rows($sessions);
            $sumtime=$this->status_network_time($data);
            $w=$this->speed_avg($data);
            
               $SPEED_AVG  = $w["SPEED_AVG"];
               $Kspeed     = $w["Kspeed"];
               $Pspeed_min = $w["Pspeed_min"];
               $Pspeed_max = $w["Pspeed_max"];
               $SPEED_NORMA =$w["SPEED_NORMA"];
            
            
            foreach ($sessions as $row){
                    $technology = $row["technology"];
                    if($this->delay_ip($row["idsession"])                       == "bad")   {$NUM_delay++;}; 
                    if($this->los_ip($row["idsession"])                         == "bad")   {$NUM_los++;}; 
                    if($this->speed_bad($row["idsession"],$row["technology"])   == "bad")   {$NUM_speed++;}; 
                    if($this->reconnect($row["idsession"])                      == "bad")   {$NUM_reconnect++;}; 
                }
                
                $quality=$this->quality_status();
                foreach ($quality as $Q)
                {
                    $Qtimedelay=$Q["timedelay"];
                    $Qpacket_los=$Q["packet_los"];
                    $Qgot=$Q["Kgot"];
                    $Qrecon=$Q["Preconnect"];
                    $Qdelay=$Q["Pdelay"];
                    $Qlos=$Q["Plos"];
                    $Qspeed=$Q["Pspeed"];
                    $Qcon=$Q["Pcon"];
                }
                
                //Количество соединений удовретворяющих нормам по задержкам
                $Num_ij = ($Num-$NUM_delay); 
                //Количество соединений удовретворяющих нормам по потери
                $Num_id = ($Num-$NUM_los);
                //Количество соединений удовретворяющих нормам по разрывам
		$Num_ih = ($Num-$NUM_reconnect);
                //Количество соединений удовретворяющих нормам по скорости
		$Num_iq = ($Num-$NUM_speed);
                
                //Доля соединений удовлетворяющих нормам по задержкам (норма 90%)
		$Kd=round(((abs($Num-$NUM_delay)/$Num)*100),2);
                //Доля соединений удолетворяющих нормам по потерям  $Klos."%<br>";
		$Klos=round(((abs($Num-$NUM_los)/$Num)*100),2);
                //Доля соединений c  разрывам связи  ". $Krecon;
		$Krecon=round((($NUM_reconnect/$Num)*100),2);
                //Доля соединений удолетворяющих нормам по скорости ". $Ks."%<br>";
		$Ks=round(((abs($Num-$NUM_speed)/$Num)*100),2);
                //Доля успешных попыток соедения от общего количества 
                $Kc = round(((abs($Num)/($Num+$session_error))*100),2);
 
       $this->add_to_array(
                            $NUM_reconnect,
                            $NUM_delay,
                            $NUM_speed,
                            $NUM_los,
                            $SPEED_AVG,
                            $Kspeed,
                            $Pspeed_min, 
                            $SPEED_NORMA,
                            $Num_ij,
                            $Num_id, 
                            $Num_ih, 
                            $Num_iq, 
                            $Kd, 
                            $Klos,
                            $Krecon,
                            $Ks,
                            $Qgot,
                            $Qrecon,
                            $Qdelay,
                            $Qlos,
                            $Qspeed, 
                            $session_error,
                            $Num,
                            $sumtime,
                            $Kc,
                            $Qcon
               );
                   
        }else die ("Нет данных");
      return $this->arr;
    }
       
        
	public function get_data_wll($data)
	{
                
                return $data_out = $this->quality($data);      
        }
        public function get_data_pon($data)
	{
                
                return $data_out = $this->quality($data);      
        }
        public function get_data_wifi($data)
	{
               
                return $data_out = $this->quality($data);      
        }
        public function get_data_adsl($data)
	{
                
                return $data_out = $this->quality($data);      
        }
   }
        
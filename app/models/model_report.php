<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace model;
use app\model;

class model_report extends model
{
    public $connect;
    public $arr=array();
    
    #Получение списка сессий для указанной технологии и периода времени
    private function session_data ($data) {   
        if(isset($data)) {           
            $query='SELECT * FROM `session` where technology="'.$data["target"].'" and date BETWEEN "'.$data["date_first"].'" AND "'.$data["date_last"].'"'; 
            if($result=mysqli_query($this->connect,$query)) { 
            if($num_rows =  mysqli_num_rows($result) !== 0){
                return $result;
            } else die ("Нет сессий за указанный период!");
            }else die ("Нет сессий за указанный период!");
        }
    }
    #Получении длительности сессии в минутах
    private function time_session ($data) {
         if(isset($data) && !empty($data)) {
            $query_time='SELECT date, time_in, TIMEDIFF(time_out, time_in) as time  FROM `session` where idsession="'.$data.'"';
                if($result=mysqli_query($this->connect,$query_time))
                {
                    return $result;
                }
         }
    }
    #Получения среднего значения пинга на ASBR для сессии. Пинг делиться на 2 согласно инструкции
    private function avg_ping_asbr ($data) {
        if(isset($data) && !empty($data)) {
            $query_asbr='SELECT AVG(ping_avg)/2 as AVG_PING_ASBR FROM `pingstats` where idsession="'.$data.'" and target="asbr"';
            if($result=mysqli_query($this->connect,$query_asbr))
            {
                foreach ($result as $row) 
                {
                        return $row["AVG_PING_ASBR"];
                }
            }else                die ("Что-то пошло не так!!!");
        }else             die ("Что-то пошло не так!!!");
    }
    
    #Получения среднего значения пинга на DNS для сессии. Пинг делиться на 2 согласно инструкции
    private function avg_ping_dns ($data) {
        if(isset($data) && !empty($data)) {
            $query_dns ='SELECT AVG(ping_avg)/2 as AVG_PING_DNS FROM `pingstats` where idsession="'.$data.'" and target like "dns_"';
            if($result=mysqli_query($this->connect,$query_dns)){
                foreach ($result as $row)
                {   
                    return $row["AVG_PING_DNS"];
                    
                }
            }   else                die ("Что-то пошло не так!!!");   
        }else             die ("Что-то пошло не так!!!");
    }
    
    #Получения среднего значения скорости для сессии.
    private function avg_speed ($data) {       
        if(isset($data) && !empty($data)) {
            $query_speed='SELECT AVG(speed)*8 as AVG_SPEED FROM `speedstats` where idsession="'.$data.'"';
            if($result=mysqli_query($this->connect,$query_speed)){
                foreach ($result as $row)
                {
                    return $row["AVG_SPEED"];
                }
            } else                die ("Что-то пошло не так!!!");   
        }else                die ("Что-то пошло не так!!!");   
    }
    #Получения среднего значения скорости для сессии PON (значение переводится из MB/s в KB/s.
    private function avg_speed_pon ($data) { 
        if(isset($data) && !empty($data)) {
            $query_speed='SELECT (AVG(speed)*8192) as AVG_SPEED FROM `speedstats` where idsession="'.$data.'"';
            if($result=mysqli_query($this->connect,$query_speed)){
                foreach ($result as $row)
                {                  
                    return $row["AVG_SPEED"];
                }
            } else                die ("Что-то пошло не так!!!");   
        }else                die ("Что-то пошло не так!!!");   
    }
    #функция получения количество пинг тестов на dns и asbr
    private function sum_ping ($data) {
        $ch = 0;
        $pl_asbr = 0;
        $cn = 0;
        $pl_dns = 0;
            if(isset($data) && !empty($data)) {
                $query_sum_asbr='SELECT * FROM `pingstats` where idsession="'.$data.'" and target="asbr"';
                $query_sum_dns ='SELECT * FROM `pingstats` where idsession="'.$data.'" and target like "dns_"';  
                
                if($result=mysqli_query($this->connect,$query_sum_asbr))
                {
                    if($num_rows=mysqli_num_rows($result) !== 0)
                    {
                       $out["ASBR"] = mysqli_num_rows($result);
                    }
                    
                    foreach ($result as $j)
                    {
                        if ($j["ping_avg"]/2 <= 400)
                        {   
                            $ch=++$ch;
                        } 
                        if ($j["packet_loss"] <=3)
                        {
                            $pl_asbr=++$pl_asbr;
                        }
                    }
                    
                  $out["ASBR_NORMA"]=$ch;
                  $out["PACKET_LOS_ASBR_NORMA"]=$pl_asbr;
                }
                 if($result=mysqli_query($this->connect,$query_sum_dns))
                 {
                     if(mysqli_num_rows($result) !== 0)
                     {
                       $out["DNS"] = mysqli_num_rows($result);
                     }
                     foreach ($result as $i)
                    {
                        if ($i["ping_avg"]/2 <= 400)
                        {   
                            $cn=++$cn;
                        } 
                         if ($i["packet_loss"] <=3)
                        {
                            $pl_dns=++$pl_dns;
                        }
                    }
                  $out["PACKET_LOS_DNS_NORMA"]=$pl_dns;
                  $out["DNS_NORMA"]=$cn;
                 }
                return ($out); 
            }   
    }
    
  
    //Добавление полученных данных для сессии в массив $arr - двухмерный массив
    private function add_to_array ($Session, $date, $time_in, $time, $speed, $asbr_ping, $asbr_num, $asbr_norma, $dns_ping, $dns_num, $dns_norma, $packet_los_asbr, $packet_los_dns) {
           
           $this->arr[] = array(
                            'Session' => $Session,
                            'Date' => $date,
                            'Time_in' => $time_in,
                            'Time' => $time, 
                            'Speed' => $speed, 
                            'ASBR_PING' => $asbr_ping, 
                            'ASBR_NUM' => $asbr_num, 
                            'ASBR_NORMA' => $asbr_norma, 
                            'DNS_PING' => $dns_ping, 
                            'DNS_NUM' => $dns_num,
                            'DNS_NORMA' => $dns_norma,
                            'PACKET_LOS_ASBR_NORMA' => $packet_los_asbr,
                            'PACKET_LOS_DNS_NORMA' => $packet_los_dns,
                   );
    }
    #Функция формирует все данные для сессий и передает двумеррный масcив    
    private function session_normal ($data) {
        $sessions = $this->session_data($data);
        if(is_object($sessions)) {
                foreach ($sessions as $row) { 
                    #Проверка на ошибки 
                        if ($row["error"]) 
                            {
                                continue;
                            }
                    $Session = $row["idsession"] . "<br />";
                    if($row["technology"]=="pon"){
                       $speed=$this->avg_speed_pon($row['idsession']);
                    } else {
                       $speed=$this->avg_speed($row['idsession']);
                    }
                       $asbr_ping=$this->avg_ping_asbr($row['idsession']);
                       $dns_ping=$this->avg_ping_dns($row['idsession']); 
                       
                       foreach ($this->time_session($row['idsession']) as $a)
                           {
                                $time=$a["time"];
                                $time_in=$a["time_in"];
                                $date=$a["date"];
                           }
                        $b=$this->sum_ping($row['idsession']);   
                        $asbr_num=$b["ASBR"];
                        $dns_num= $b["DNS"];   
                        $asbr_norma=$b["ASBR_NORMA"];
                        $dns_norma=$b["DNS_NORMA"];
                        $packet_los_asbr=$b["PACKET_LOS_ASBR_NORMA"];
                        $packet_los_dns=$b["PACKET_LOS_DNS_NORMA"];
                  
            $this->add_to_array($Session, $date, $time_in, $time, $speed, $asbr_ping, $asbr_num, $asbr_norma, $dns_ping, $dns_num, $dns_norma, $packet_los_asbr, $packet_los_dns);
                      }
        }
        return $this->arr;
    }
    public function get_data_wll($data)
	{
                $this->connect = Model::$db_connection;           
                return $data_out = $this->session_normal($data);         
        }
    public function get_data_adsl($data)
	{
                $this->connect = Model::$db_connection;
                return $data_out = $this->session_normal($data);         
        }
    public function get_data_pon($data)
	{
                $this->connect = Model::$db_connection;
                return $data_out = $this->session_normal($data);         
        }
    public function get_data_wifi($data)
	{
                $this->connect = Model::$db_connection;
                return $data_out = $this->session_normal($data);   
        }

}

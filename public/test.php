<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
  
$a = array(0=>array (
        "hello"=>1,
        "name"=>"Dmitry",
        "hello"=>1,
        "123"=>2
   ), 1=>array(
        "hello"=>1,
        "name"=>"Dallas",
        "hello"=>1,
        "123"=>2
   ),
    2=>array(
        "hello"=>1,
        "name"=>"Atlas",
        "hello"=>1,
        "123"=>2
   )
);
$arr = ["sitepoint", "phpmaster", "buildmobile", "rubysource", "designfestival", "cloudspring"];

$b= array();

$b = array(
                            'Session' => 1,
                            'Date' => 2,
                            'Time_in' => 3,
                            'Time' => 4, 
                            'Speed' => 5, 
                            'ASBR_PING' => 6, 
                            'ASBR_NUM' => 7, 
                            'ASBR_NORMA' => 8, 
                            'DNS_PING' => 9, 
                            'DNS_NUM' => 10,
                            'DNS_NORMA' => 11,
                            'PACKET_LOS_ASBR_NORMA' => 12,
                            'PACKET_LOS_DNS_NORMA' => 13,
                   );

                   foreach ($b as $key=>$row) {
                       echo $key ." ".$row."<br/>";
                   }
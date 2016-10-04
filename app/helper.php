<?php

defined('_APP') or die('Restricted access');

class Helper
{

  //get real client ip
  public static function getIpAddr() {

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
         
         $ip = $_SERVER['HTTP_CLIENT_IP'];
      
      }  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      
      } else {
         
         $ip = $_SERVER['REMOTE_ADDR'];
      }
     
     return $ip;
  }

}
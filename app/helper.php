<?php

defined('_APP') or die('Restricted access');

class Helper
{

  //get real client ip
  public static function getIpAddr() 
  {

      if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
         
         $ip = $_SERVER['HTTP_CLIENT_IP'];
      
      }  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         
         $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
      
      } else {
         
         $ip = $_SERVER['REMOTE_ADDR'];
      }
     
     return $ip;
  }

  public static function getBrowser()
  {
      $user_agent = $_SERVER["HTTP_USER_AGENT"];
      
      if (strpos($user_agent, "Firefox") !== false) $browser = "firefox";
      elseif (strpos($user_agent, "Opera") !== false) $browser = "opera";
      elseif (strpos($user_agent, "Chrome") !== false) $browser = "chrome";
      elseif (strpos($user_agent, "MSIE") !== false) $browser = "ie";
      elseif (strpos($user_agent, "Safari") !== false) $browser = "safari";
      else $browser = "noname";

      return $browser;
  }

}
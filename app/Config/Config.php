<?php
class Config
 {
     static public $mvc_bd_hostname = "localhost";
     static public $mvc_bd_nombre   = "phplv1";
     static public $mvc_bd_usuario  = "phplv1";
     static public $mvc_bd_password    = "phplv1";
     
     
     static protected $basePath = "phplv1/";
     
     
     
     public static function getBasePath(){
         return self::$basePath;
     }
 }
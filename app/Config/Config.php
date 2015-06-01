<?php
/**
* Clase de configuraciones para el funcionamiento de la página
* La mayoría de de los atributos y métodos son estáticos
*/
class Config
 {
     static protected $mvc_bd_hostname = "localhost";
     static protected $mvc_bd_nombre   = "phplv1";
     static protected $mvc_bd_usuario  = "phplv1";
     static protected $mvc_bd_password    = "phplv1";
     static protected $basePath = "phplv1/";
     static protected $URL = 'http://localhost/phplv1/';
     
     
     
     public static function getHost(){
         return self::$mvc_bd_hostname;
     }
     public static function getName(){
         return self::$mvc_bd_nombre;
     }
     public static function getUser(){
         return self::$mvc_bd_usuario;
     }
     public static function getPassword(){
         return self::$mvc_bd_password;
     }
     public static function getBasePath(){
         return self::$basePath;
     }
     public static function getURL(){
         return self::$URL;
     }
 }
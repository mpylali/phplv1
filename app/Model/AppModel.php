<?php
include '/../Config/Config.php';
class AppModel
 {
     protected $conexion;

     public function __construct($dbname,$dbuser,$dbpass,$dbhost)
     {
       $mvc_bd_conexion = mysqli_connect($dbhost, $dbuser, $dbpass);

       if (!$mvc_bd_conexion) {
           die('No ha sido posible realizar la conexión con la base de datos: ' . mysqli_error());
       }
       mysqli_select_db($mvc_bd_conexion, $dbname);

       mysqli_set_charset($mvc_bd_conexion, 'utf8');

       $this->conexion = $mvc_bd_conexion;
     }
 }
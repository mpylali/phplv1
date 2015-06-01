<?php
require_once '/../Config/Config.php';
class AppModel
 {
     protected $conexion;

     public function __construct($dbname,$dbuser,$dbpass,$dbhost)
     {
         
        @$mysqli = new mysqli($dbhost, $dbuser, $dbname, $dbname);
        
        if ($mysqli->connect_errno) {
            die("Fallo al contenctar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error);
        }
        
       mysqli_select_db($mysqli, $dbname);

       mysqli_set_charset($mysqli, 'utf8');

       $this->conexion = $mysqli;
     }
     
     public function getConexion(){
         return $this->conexion;
     }
     
     public function cerrarConexion(){
         mysqli_close($this->conexion);
     }
 }
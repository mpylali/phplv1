<?php
include 'AppModel.php';
include '/../lib/Validacion.php';
class UsuariosModel extends AppModel{
    protected $reglas = array( 
            array('name'=>'usuario','regla'=>'no-empty'),
            array('name'=>'contrasena','regla'=>'no-empty,numeric'),
            array('name'=>'activo','regla'=>'no-empty'),
            );
    
    
    
    
     public function agregarUsuario($usuario, $contrasena)
     {
         $sql = "INSERT INTO `phplv1`.`usuarios` (`id`, `nombre_usuario`, `contrasena`) VALUES (NULL, '".$usuario ."', '".$contrasena."');";
         //var_dump($sql);
         $result = mysqli_query($this->conexion, $sql );
         return $result;
     }
     
     public function buscarTodos(){
         $sql = "SELECT * FROM `usuarios`;";

         $result = mysqli_query($this->conexion, $sql);

         $usuarios = array();
         while ($row = mysqli_fetch_assoc($result))
         {
             $usuarios[] = $row;
         }

         return $usuarios;
     }

     public function validarDatos($datos)
     {
         $validacion =  new Validacion();
         
         $validaciones = $validacion->rules($this->reglas,$datos);
         return $validaciones;
     }
     
     
     
}

<?php
include 'AppModel.php';
class UsuariosModel extends AppModel{
    
     public function agregarUsuario($usuario, $contrasena)
     {
         $usuario = htmlspecialchars($usuario);
         $contrasena = htmlspecialchars($contrasena);
         
         $sql = "INSERT INTO `phplv1`.`usuarios` (`id`, `nombre_usuario`, `contrasena`) VALUES (NULL, '".$usuario ."', '".$contrasena."');";
         //var_dump($sql);
         $result = mysqli_query($this->conexion, $sql );
         return $result;
     }
     
     public function buscarTodos(){
         $sql = "SELECT * FROM `usuarios`";

         $result = mysqli_query($this->conexion, $sql);

         $usuarios = array();
         while ($row = mysqli_fetch_assoc($result))
         {
             $usuarios[] = $row;
         }

         return $usuarios;
     }

     public function validarDatos($usuario, $contrasena)
     {
         return (is_string($usuario) & is_string($contrasena) & !empty($usuario) & !empty($contrasena));
     }
     
     public function campoVacio(){
         
     }
     
}

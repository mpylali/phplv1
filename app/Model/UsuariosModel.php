<?php
include 'AppModel.php';
include '/../lib/Validacion.php';
date_default_timezone_set('America/Mexico_City');

class UsuariosModel extends AppModel{
    protected $reglas = array( 
            array('name'=>'usuario','regla'=>'no-empty,alpha-numeric,unique'),
            array('name'=>'contrasena','regla'=>'no-empty'),
            array('name'=>'img','regla'=>'image'),
            );
    
     public function agregarUsuario($datos)
     {
        $imgData = file_get_contents($datos['img']['tmp_name']);
        $imgData = mysqli_escape_string($this->getConexion(),$imgData);
        //var_dump($imgData);
        $string = "'NULL','".$datos['usuario']." ','".$datos['contrasena']."','".$imgData."','".$datos['img']['type']."','".$datos['img']['size']."','".date('Y-m-d')."'";
        $sql2 = "INSERT INTO `phplv1`.`usuarios` (`id`, `nombre_usuario`, `contrasena`, `img`, `img_mime`, `img_size`, `creado`) VALUES ($string);";
        $result = mysqli_query($this->getConexion(), $sql2 );
        $this->cerrarConexion();
        return $result;
     }
     
     public function editarUsuario($datos)
     {
         if($datos['img']['error']==0){
            $imgData = file_get_contents($datos['img']['tmp_name']);
            $imgData = mysqli_escape_string($this->getConexion(),$imgData);
            $sql = "UPDATE `phplv1`.`usuarios` SET "
                . " `contrasena` = '".$datos['contrasena']."', `img` = '".$imgData."', `img_mime` = '".$datos['img']['type']."', "
                . "`img_size` = '".$datos['img']['size']."' WHERE `usuarios`.`id` = ".$datos['id']." ;";
         }  else {
         
            $sql = "UPDATE `phplv1`.`usuarios` SET "
                . " `contrasena` = '".$datos['contrasena']."', `img` = '".mysqli_escape_string($this->getConexion(),$datos['imgOld']['img'])."', `img_mime` = '".$datos['imgOld']['img_mime']."', "
                . "`img_size` = '".$datos['imgOld']['img_size']."' WHERE `usuarios`.`id` = ".$datos['id']." ;";
         }
        
        $result = mysqli_query($this->getConexion(), $sql );
        $this->cerrarConexion();
        return $result;
     }
     
     public function buscarTodos(){
         $sql = "SELECT * FROM `usuarios`;";

         $result = mysqli_query($this->getConexion(), $sql);

         $usuarios = array();
         while ($row = mysqli_fetch_assoc($result))
         {
             $usuarios[] = $row;
         }
         //var_dump($result);
         $result->close();
         $this->cerrarConexion();
         //var_dump($usuarios);
         return $usuarios;
     }
     
     public function buscarId($id){
         $sql = "SELECT * FROM `usuarios` WHERE `id` = $id;";

         $result = mysqli_query($this->getConexion(), $sql);
         $num = mysqli_num_rows($result);
         if($num > 0){
             $usuario = mysqli_fetch_assoc($result);
             $result->close();
         } else {
             $usuario = NULL;
         }
         //var_dump($usuarios);
         return $usuario;
     }
     
    public function existe($id){
         $sql = "SELECT `id` FROM `usuarios` WHERE `id` = $id;";
         //var_dump($sql);
         $result = mysqli_query($this->getConexion(), $sql);
         //var_dump($result);
         //exit;
         $num = mysqli_num_rows($result);
         if($num > 0){
             return true;
         } else {
             return false;
         }
     }

     public function validarDatos($datos)
     {
         $validacion =  new Validacion();
         $validaciones = $validacion->rules($this->reglas,$datos);
         return $validaciones;
     }
     
     
     
}

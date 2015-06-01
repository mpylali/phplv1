<?php
include 'AppModel.php';
include '/../lib/Validacion.php';
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

     public function validarDatos($datos)
     {
         $validacion =  new Validacion();
         
         $validaciones = $validacion->rules($this->reglas,$datos);
         return $validaciones;
     }
     
     
     
}

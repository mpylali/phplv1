<?php
include '/../Model/UsuariosModel.php';
class UsuariosController extends AppController{
    
    public function index()
     {
         $params = array(
             'titulo' => 'Usuarios'
         );
         
         $m = new UsuariosModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_password, Config::$mvc_bd_hostname);

         $params['usuarios'] = $m->buscarTodos();
         
         require __DIR__ . '\..\View\Usuarios\index.php';
     }
    
    public function agregar()
     {
        $datos = array();
        $params = array(
             'titulo' => 'Agregar Usuario',
             'mensaje' => '',
         );
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $m = new UsuariosModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_password, Config::$mvc_bd_hostname);
             // comprobar campos formulario
             $datos = $_POST;
             @$datos['img'] = $_FILES['img'];
             $msg = $m->validarDatos($datos);
             
             //var_dump($msg);
             if (is_bool($msg)) {
                 if($m->agregarUsuario($datos)){
                     $this->redirecionar($_SERVER,'usuarios','index');
                 }  else {
                     $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 }
                 
             } else {
                 $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 $params['msg'] = $msg;
             }
             $m->cerrarConexion();
         }
        
        
        require __DIR__ . '\..\View\Usuarios\agregar.php';
     }
}


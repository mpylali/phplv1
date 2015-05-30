<?php
include '/../Model/UsuariosModel.php';
class UsuariosController extends AppController{
    
    public function index()
     {
         $params = array(
             'titulo' => 'Usuarios'
         );
         
         $m = new UsuariosModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_clave, Config::$mvc_bd_hostname);

         $params['usuarios'] = $m->buscarTodos();
         
         require __DIR__ . '\..\View\Usuarios\index.php';
     }
    
    public function agregar()
     {
        $params = array(
             'titulo' => 'Agregar Usuario',
             'mensaje' => '',
         );
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $m = new UsuariosModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
             // comprobar campos formulario
             
             $msg = $m->validarDatos($_POST);
             //var_dump($msg);
             if (is_bool($msg)) {
                 echo 'puedo agragar';
                 exit;
                 if($m->agregarUsuario($_POST['usuario'], $_POST['contrasena'])){
                     header('Location: index');
                 }  else {
                     $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 }
                 
             } else {
                 $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 $params['msg'] = $msg;
             }

         }
        
        
        require __DIR__ . '\..\View\Usuarios\agregar.php';
     }
}


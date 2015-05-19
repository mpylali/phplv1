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
             'usuario' => '',
             'contrasena' => ''
         );
        
         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             $m = new UsuariosModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario, Config::$mvc_bd_clave, Config::$mvc_bd_hostname);
             // comprobar campos formulario
             if ($m->validarDatos($_POST['usuario'], $_POST['contrasena'])) {
                 
                 if($m->agregarUsuario($_POST['usuario'], $_POST['contrasena'])){
                     header('Location: index');
                 }  else {
                     $params['usuario'] = $_POST['usuario'];
                     $params['contrasena'] = $_POST['contrasena'];
                     $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 }
                 
             } else {
                 $params['usuario'] = $_POST['usuario'];
                 $params['contrasena'] = $_POST['contrasena'];
                 $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
             }

         }
        
        
        require __DIR__ . '\..\View\Usuarios\agregar.php';
     }
}


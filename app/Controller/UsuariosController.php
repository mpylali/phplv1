<?php
include '/../Model/UsuariosModel.php';
class UsuariosController extends AppController{
    
    public function index()
     {
         $params = array(
             'titulo' => 'Usuarios'
         );
         
         $model = new UsuariosModel(Config::getName(), Config::getUser(),Config::getPassword(), Config::getHost());

         $params['usuarios'] = $model->buscarTodos();
         
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
             $model = new UsuariosModel(Config::getName(), Config::getUser(),Config::getPassword(), Config::getHost());
             // comprobar campos formulario
             $datos = $_POST;
             @$datos['img'] = $_FILES['img'];
             $valid = $model->validarDatos($datos);
             
             //var_dump($msg);
             if (is_bool($valid)) {
                 if($model->agregarUsuario($datos)){
                     $this->redirect($_SERVER,'usuarios','index');
                 }  else {
                     $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 }
             } else {
                 $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 $params['msg'] = $valid;
             }
             $model->cerrarConexion();
         }    
        require __DIR__ . '\..\View\Usuarios\agregar.php';
     }
     
    public function view($id = null){
        $params = array(
             'titulo' => 'Información de usuario',
         );
        $model = new UsuariosModel(Config::getName(), Config::getUser(),Config::getPassword(), Config::getHost());
        
        if($model->existe($id)){
            $params['usuario'] = $model->buscarId($id);
        }else{
            throw new NotFoundException(__('No existe registro'));
        }
        $model->cerrarConexion();
        require __DIR__ . '\..\View\Usuarios\view.php'; 
    }
    
    public function edit($id = null){
        $params = array(
             'titulo' => 'Editar Usuario',
         );
        $model = new UsuariosModel(Config::getName(), Config::getUser(),Config::getPassword(), Config::getHost());
        if(!$model->existe($id)){
            throw new NotFoundException(__('No existe registro'));
        }
        
        $params['usuario'] = $model->buscarId($id);
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
             // comprobar campos formulario
             $datos = $_POST;
             @$datos['img'] = $_FILES['img'];
             
             $valid = $model->validarDatos($datos);
             
             @$datos['imgOld'] = $params['usuario'];
             
             if (is_bool($valid)) {
                 if($model->editarUsuario($datos)){
                     $this->redirect($_SERVER,'usuarios','index');
                 }  else {
                     $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 }
             } else {
                 $params['mensaje'] = 'No se ha podido insertar el usuario. Revisa el formulario';
                 $params['msg'] = $valid;
             }
             
         }    
        
        
        
        
        require __DIR__ . '\..\View\Usuarios\edit.php'; 
    }
    
    public function delete(){
        //require __DIR__ . '\..\View\Usuarios\delete.php'; 
    }
}


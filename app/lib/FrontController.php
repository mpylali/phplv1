<?php
include 'FrontControllerInterface.php';
function __autoload($clase) {  
    $path = __DIR__ . '/../Controller/'.$clase . '.php';
    if(file_exists($path)){
        require_once $path;
    }
}
class FrontController implements FrontControllerInterface
{
    const DEFAULT_CONTROLLER = "PagesController";
    const DEFAULT_ACTION     = "index";
     
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath      = "phplv1/";
     
    public function __construct(array $options = array()) {
        if (empty($options)) {
           $this->parseUri();
        }
        else {
            if (isset($options["controller"])) {
                $this->setController($options["controller"]);
            }
            if (isset($options["action"])) {
                $this->setAction($options["action"]);     
            }
            if (isset($options["params"])) {
                $this->setParams($options["params"]);
            }
        }
    }
     
    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/").'/';//Solo para el inicio
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
        if (strpos($path, $this->basePath) === 0) {
            $path = substr($path, strlen($this->basePath));
        }
        @list($controller, $action, $params) = explode("/", $path, 3);
        if (!empty($controller)) {
            try {
                $this->setController($controller);
            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
            
        }
        if (!empty($action)) {
            try {
                $this->setAction($action);
            } catch (Exception $e) {
                echo 'Excepción capturada: ',  $e->getMessage(), "\n";
            }
        }
        if (!empty($params)) {
            $this->setParams(explode("/", $params));
        }
    }
     
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new Exception("El controlador: '$controller' no ha sido definido.");
        }
        $this->controller = $controller;
        return $this;
    }
     
    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new Exception("La acción: '$action' no ha sido definida.");
        }
        $this->action = $action;
        return $this;
    }
     
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
     
    public function run() {
//        var_dump($this->controller);
//        var_dump($this->action);
//        var_dump($this->params);
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}
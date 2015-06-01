<?php
require_once '/../Config/Config.php';
/**
 * Función que carga clases automáticamente   
 */
function __autoload($clase) {  
    $path = __DIR__ . '/../Controller/'.$clase . '.php';
    if(file_exists($path)){
        require_once $path;
    }
}
/**
* Clase para realizar las funciones de redireccionamiento para cada petición a la página
* Patrón que centraliza el acceso de las peticiones provenientes del cliente.
*
*/
class FrontController
{
    const DEFAULT_CONTROLLER = "PagesController";
    const DEFAULT_ACTION     = "index";
     
    protected $controller    = self::DEFAULT_CONTROLLER;
    protected $action        = self::DEFAULT_ACTION;
    protected $params        = array();
    protected $basePath;
     
    public function __construct(array $options = array()) {
        $this->basePath = Config::getBasePath();
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
     
    /**
    * Método para analizar la dirección de petición del cliente
    * El método extrae los componentes principales de la URL para su direccionamiento
    * y asigna a los atibutos de la misma clase (Controlador, acción y parámetros)
    */
    protected function parseUri() {
        $path = trim(parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH), "/").'/';//Solo para el inicio
        $path = preg_replace('/[^a-zA-Z0-9]\//', "", $path);
        //var_dump($path);
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
    
    /**
    * Método que asigna el nombre del controlador
    * El método asigna a su atributo el valor del nombre del controlador solicitado, si no existe
    * se coloca por default el indicado en la constante de la clase
    */
    public function setController($controller) {
        $controller = ucfirst(strtolower($controller)) . "Controller";
        if (!class_exists($controller)) {
            throw new Exception("El controlador: '$controller' no ha sido definido.");
        }
        $this->controller = $controller;
        return $this;
    }
    
    /**
    * Método que asigna el nombre de la acción
    * El método asigna a su atributo el valor del nombre de la acción solicitada, si no existe
    * se coloca por default el indicado en la constante de la clase
    */
    public function setAction($action) {
        $reflector = new ReflectionClass($this->controller);
        if (!$reflector->hasMethod($action)) {
            throw new Exception("La acción: '$action' no ha sido definida.");
        }
        $this->action = $action;
        return $this;
    }
    
    /**
    * Método que asigna los parámetros
    * El método asigna a su atributo el valor de los parámetros enviados, si no existen
    * se coloca por default el indicado en el atributo de esta clase
    */
    public function setParams(array $params) {
        $this->params = $params;
        return $this;
    }
    
    /**
    * Método que llama al controlador específico
    * El método llama al controlador, acción y parámetros específicos de la clase
    */
    public function run() {
        call_user_func_array(array(new $this->controller, $this->action), $this->params);
    }
}
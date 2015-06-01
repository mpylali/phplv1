<?php

/**
/**
* Clase para realizar validaciones en el modelo
* Es utilizada para realizar validaciones en el modelo de nuestras clases.
*
*/
class Validacion
{
 public $_atributos;
 public $mensaje;
 protected $_resultado = TRUE;
 
 
 /**
  * Asigna los datos del formulario como atributos
  */
 
 protected function setAtributos($data){
     $this->_atributos = $data;
 }

 /**
 * Metodo para indicar la regla de validacion
 * El método retorna un valor verdadero si la validación es correcta, de lo contrario retorna el objeto 
 * actual, permitiendo acceder al atributo Validacion::$mensaje ya que es publico
 */
 public function rules($rule = array(),$data)
 {
  $this->setAtributos($data);
  if(!is_array($rule)){
   $this->mensaje = "las reglas deben de estar en formato de arreglo";
   return $this;
  }  
  foreach($rule as $key => $rules){
   $reglas = explode(',',$rules['regla']);
   if(array_key_exists($rules['name'],$data)){
    foreach($data as $indice => $valor){     
     if($indice === $rules['name']){
      foreach($reglas as $clave => $valores){ 
       $validator = $this->_getInflectedName($valores);        
       if(!is_callable(array($this, $validator))){
          throw new BadMethodCallException("No se encontro el metodo actual");
       }
       $respuesta = $this->$validator($rules['name'], $valor);        
       $this->_resultado &= $respuesta;
      }
      break;
     }
    }
   }
   else{
    //$this->mensaje[$rules['name']] = "el campo $value no esta dentro de la regla de validación o en el formulario";    
   }
  }  
  if($this->_resultado == 0){
   return $this;
  }
  else{
   return true;
  }
 } 
 
 /**
 * Metodo inflector de la clase 
 * por medio de este metodo llamamos a las reglas de validacion que se generen
 */
 private function _getInflectedName($text)
 {
     $validator = '';
  $_validator = preg_replace('/[^A-Za-z0-9]+/',' ',$text);
  $arrayValidator = explode(' ',$_validator);    
  if(count($arrayValidator) > 1){
   foreach($arrayValidator as $key => $value){     
    if($key == 0){
     $validator .= "_".$value; 
    }
    else{     
     $validator .= ucwords($value);
    }
   }
  }
  else{
   $validator = "_".$_validator;
  }    
  return $validator;
 }
  
 /**
 * Metodo de verificacion de que el dato no este vacio o NULL
 * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
 * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el 
 * mensaje que visualizara el usuario
 */
 protected function _noEmpty($campo,$valor)
 {   
  if(isset($valor) && !empty($valor)){   
   return true;   
  }
  else{   
   $this->mensaje[$campo][] = "El campo no debe de estar vacio";
   return false;
  }
 }
 /**
 * Metodo de verificacion de tipo numerico
 * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
 * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el 
 * mensaje que visualizara el usuario
 */
 protected function _numeric($campo,$valor)
 {   
  if(is_numeric($valor)){
   return true;
  }  
  else{
   $this->mensaje[$campo][] = "El campo debe de ser numérico";
   return false;
  }
 }
 
 /**
 * Metodo de verificacion de tipo alfanumerico
 * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
 * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el 
 * mensaje que visualizara el usuario
 */
 protected function _alphaNumeric($campo,$valor)
 {   
  if(ctype_alnum($valor)){
   return true;
  }  
  else{
   $this->mensaje[$campo][] = "El campo debe de ser alfanumérico";
   return false;
  }
 }
 
 protected function _image($campo,$valor){
     
     if ((isset($valor['error']) && $valor['error'] == 0) || (!empty( $valor['tmp_name']) && $valor['tmp_name'] != 'none')) {

            if(is_uploaded_file($valor['tmp_name'])) {
                // check the file is less than the maximum file size 10 MB 
                //var_dump($valor);
                if($valor['size'] < 5242880)
                {
                    if(substr($valor['type'], 0,5) == 'image'){
                        return true;
                    }else{
                        $this->mensaje[$campo][] = "El archivo no es una imagen";
                        return false;
                    }
                    
                }else{
                    $this->mensaje[$campo][] = "El archivo excede el tamaño maximo para subir (5 MB)";
                    return false;
                }
            }else{
                $this->mensaje[$campo][] = "Posible ataque del archivo subido";
                return false;
            }

        }else{
            $this->mensaje[$campo][] = "No se eligio un archivo";
            return false;
        }
 }
 
 protected function _file($campo,$valor){
     
     if ((isset($valor['error']) && $valor['error'] == 0) || (!empty( $valor['tmp_name']) && $valor['tmp_name'] != 'none')) {

            if(is_uploaded_file($valor['tmp_name'])) {
                // check the file is less than the maximum file size 10 MB 
                //var_dump($valor);
                if($valor['size'] < 5242880)
                {
                    return true;
                }else{
                    $this->mensaje[$campo][] = "El archivo excede el tamaño maximo para subir (5 MB)";
                    return false;
                }
            }else{
                $this->mensaje[$campo][] = "Posible ataque del archivo subido";
                return false;
            }

        }else{
            $this->mensaje[$campo][] = "No se eligio un archivo";
            return false;
        }
 }
 
 protected function _unique($campo,$valor){
     $m = new AppModel(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
                     Config::$mvc_bd_password, Config::$mvc_bd_hostname);
     
     $sql = "SELECT `id` FROM `usuarios` WHERE `nombre_usuario` = '$valor'";
     $result = mysqli_query($m->getConexion(), $sql );
     $num = mysqli_num_rows($result);
     if($num > 0){
        $this->mensaje[$campo][] = "El $campo no está disponible";
        $m->cerrarConexion();
        return false;
     }else{
         $m->cerrarConexion();
         return true;
     }
 }

 /**
 * Metodo de verificacion de tipo email
 * El metodo retorna un valor verdadero si la validacion es correcta de lo contrario retorna un valor falso
 * y llena el atributo validacion::$mensaje con un arreglo indicando el campo que mostrara el mensaje y el 
 * mensaje que visualizara el usuario
 */
 protected function _email($campo,$valor)
 {
  if(preg_match("/^[a-z]+([\.]?[a-z0-9_-]+)*@[a-z]+([\.-]+[a-z0-9]+)*\.[a-z]{2,3}$/",$valor)){     
   return true;
  } 
  else{
   $this->mensaje[$campo][] = "el campo debe estar en el formato de email usuario@servidor.com";
   return false;
  }
 }
 
 
 
}
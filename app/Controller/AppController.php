<?php
require_once '/../Config/Config.php';
class AppController
 {
    public $layout = 'layout';
    


    public $Menu = array(
        array('icono'=>'fa fa-dashboard','tema'=>'Páginas',
            'contenido'=>array(
                array('icono'=>'','subtema'=>'Página de bienvenida','url'=>'pages/bienvenida'),
                array('icono'=>'','subtema'=>'Acerca de','url'=>'pages/acerca')
            )),
        array('icono'=>'fa fa-align-justify','tema'=>'Introducción',
            'contenido'=>array(
                array('icono'=>'','subtema'=>'¿Qué es PHP?','url'=>'#'),
                array('icono'=>'','subtema'=>'Herramientas de desarrollo','url'=>'#'),
                array('icono'=>'','subtema'=>'Instalación','url'=>'#'),
                array('icono'=>'','subtema'=>'Primera página con PHP','url'=>'#'),
            )),
        array('icono'=>'fa fa-pencil','tema'=>'Sintaxis básica',
            'contenido'=>array(
                array('icono'=>'','subtema'=>'Etiquetas','url'=>'#'),
                array('icono'=>'','subtema'=>'Incrustación de código PHP','url'=>'#'),
                array('icono'=>'','subtema'=>'Comentarios','url'=>'#'),
            )),
        array('icono'=>'fa fa-book','tema'=>'Tipos de datos','contenido'=>array()),
        array('icono'=>'fa fa-refresh','tema'=>'Variables','contenido'=>array()),
        array('icono'=>'fa fa-arrow-right','tema'=>'Constantes','contenido'=>array()),
        array('icono'=>'fa fa-plus','tema'=>'Operadores','contenido'=>array()),
        array('icono'=>'fa fa-hand-o-right','tema'=>'Estructuras de control','contenido'=>array()),
        array('icono'=>'fa fa-edit','tema'=>'Funciones','contenido'=>array()),
        array('icono'=>'fa fa-futbol-o','tema'=>'Clases y Objetos','contenido'=>array()),
        array('icono'=>'fa fa-file-excel-o','tema'=>'Manejo de Archivos','contenido'=>array()),
        );
    
    /**
    * Método que realiza una redirección a cada página 
    * El método obtiene los parametros indicados para realizar la redirección de página
    */
    public function redirect($server,$controller,$action = ''){
        $host  = $server['HTTP_ORIGIN'];
        header("Location: $host/".Config::getBasePath()."$controller/$action");
        exit;
    }
    
    
     

 }
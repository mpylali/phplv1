<?php
include 'AppController.php'; 
class PagesController extends AppController
 {

     public function index()
     {
         $params = array(
             'mensaje' => 'Bienvenido al curso de PHP',
             'fecha' => date('d-m-yyy'),
         );
         require __DIR__ . '\..\View\Pages\prueba.php';
     }
     
     public function prueba()
     {
         $params = array(
             'mensaje' => 'Adios al curso de PHP',
             'fecha' => date('d-m-yyy'),
         );
         require __DIR__ . '\..\View\Pages\prueba.php';
     }
     

 }


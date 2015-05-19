<?php
include 'AppController.php'; 
class PagesController extends AppController
 {

     public function index()
     {
         $params = array(
             'titulo' => 'Página de inicio'
         );
         require __DIR__ . '\..\View\Pages\index.php';
     }
     
     public function bienvenida() {
         $params = array(
             'titulo' => 'Página de bienvenida'
         );
         require __DIR__ . '\..\View\Pages\bienvenida.php';
     }
     
     public function acerca()
     {
         $params = array(
             'titulo' => 'Acerca de',
         );
         require __DIR__ . '\..\View\Pages\acerca.php';
     }
     

 }


<?php

class Validador {
    
    public function campoVacio($campo){
        return empty($campo);
    }
    
    public function campoCadena($campo){
        return is_string($campo);
    }
    
    public function campoNumerico($campo){
        return is_numeric($campo);
    }
    
    public function campoAlfabetico($campo){
        return ctype_alpha($campo);
    }
    
    public function campoAlfaNumerico($campo){
        return ctype_alnum($campo);
    }
    
}
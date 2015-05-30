<?php


class Vista{
    public static function mensajesError($array){
        $string = "";
        $string = "<div class=\"alert alert-danger alert-dismissable\">";
        $string .= "<button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button>";
        foreach ($array as $key => $mensaje):
            $string .= "<p>$mensaje</p>";
        endforeach;
        $string .= '</div>';
        echo $string;
    }
}


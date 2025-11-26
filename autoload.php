<?php

    spl_autoload_register(function($clase){      //detecta las clases que se están utilizando

        $archivo = __DIR__."/".$clase.".php";
        $archivo = str_replace("\\", "/", "$archivo");

        if(is_file($archivo)){
            require_once $archivo;
        }
    });

?>
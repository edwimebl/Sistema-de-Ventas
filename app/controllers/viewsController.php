<?php

namespace app\controllers;

use app\models\viewsModel;

class viewsController extends viewsModel
{
    //controlador para obteber las vistas

    public function obtenerVistaControlador($vista)
    {
        if ($vista != "") {
            $respuesta = $this->obtenerVistaModelo($vista);
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}

<?php

namespace app\models;

use \PDO;

if (file_exists(__DIR__ . "/../../config/server.php")) {

    require_once __DIR__ . "/../../config/server.php";
}

class mainModel
{
    //utilizamos los datos de la bd definidos en el archivo server.php
    private $server = DB_SERVER;
    private $db = DB_NAME;
    private $user = DB_USER;
    private $pass = DB_PASS;

    //Función o modelo para la conexión a la base de datos

    protected function conectar()
    {

        $conexion = new PDO("mysql:host=" . $this->server . ";dbname=" . $this->db, $this->user, $this->pass);

        $conexion->exec("SET CHARACTER SET utf8");

        return $conexion;
    }

    //Modelo para realizar consultas simples

    protected function ejecutarConsulta($consulta)
    {

        $sql = $this->conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    //Función para limpiar cadenas de texto

    public function limpiarCadena($cadena)
    {
        $palabras = ["<script>", "</script>", "<script src>", "<script type=>", "SELECT * FROM", "SELECT", "DELETE FROM", "INSERT INTO", "UPDATE SET", "DROP TABLE", "SHOW TABLES", "SHOW DATABASES", "DROP DATABASES", "TRUNCATE TABLE", "OR '1'='1'", "or", 'OR "1"="1"', 'OR ´1´=´1´', "is NULL; --", "LIKE '", 'LIKE "', "LIKE ´", "OR ´a´=´a´", 'OR "a"="a"', "OR 'a'='a'", "--", "^", "[", "]", "==", ";", "::", "--", "/*", "*/", "@@", "@", "==", "<?php", "?>"];

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        foreach ($palabras as $palabra) {
            $cadena = str_ireplace($palabra, " ", $cadena);
        }

        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);

        return $cadena;
    }

    //Función para verificar datos con expresiones regulares

    protected function virificarDatos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {

            return false;
        } else {

            return true;
        }
    }

    /*Función para ejecutar consultas  INSERT preparadas utilizando transacciones */
    protected function guardarDatos($tabla, $datos)
    {

        $query = "INSERT INTO $tabla(";

        $C = 0;

        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"];
            $C++;
        }
        $query .= ") VALUES(";

        $C = 0;

        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= "'" . $clave["campo_valor"] . "'";
            $C++;
        }

        $query .= ")";

        $sql = $this->conectar();
        $sql->beginTransaction();
        $sql->prepare($query);

        $sql->exec($query);

        return $sql;
    }

    /* Función para seleccionar datos */

    public function seleccionarDatos($tipo, $tabla, $campo, $id)
    {

        $tipo = $this->limpiarCadena($tipo);
        $tabla = $this->limpiarCadena($tabla);
        $campo = $this->limpiarCadena($campo);
        $id = $this->limpiarCadena($id);

        if ($tipo == "Unico") {
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla WHERE $campo=:ID");
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "Normal") {
            $sql = $this->conectar()->prepare("SELECT * FROM $tabla");
        }

        $sql->execute();

        return $sql;
    }

    /* Función para ejecutar una consulta UPDATE(Actualizar) preparada */

    protected function actualizarDatos($tabla, $datos, $condicion)
    {

        $query = "UPDATE $tabla SET ";

        $C = 0;

        foreach ($datos as $clave) {
            if ($C >= 1) {
                $query .= ",";
            }
            $query .= $clave["campo_nombre"] . "='" . $clave["campo_valor"] . "'";
            $C++;
        }

        $query .= "WHERE" . $condicion["condicion_campo"] . "='" . $condicion["condicion_valor"] . "'";

        $sql = $this->conectar();
        $sql->beginTransaction();
        $sql->prepare($query);

        $sql->exec($query);

        return $sql;
    }

    /* Función para eliminar registros */

    protected function eliminarRegistro($tabla, $campo, $id){

        $query = "DELETE FROM $tabla WHERE $campo = '$id'";

        $sql = $this->conectar();
        $sql->beginTransaction();
        $sql->prepare($query);

        $sql->exec($query);

        return $sql;
    }
}

//Video tutorial #23

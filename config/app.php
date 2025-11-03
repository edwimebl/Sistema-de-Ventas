<?php

const APP_URL = "http://localhost/PHP_MYSQL_/CarlosAlfaro/sistemaVentas/";
const APP_NAME = "VENTAS";
const APP_SESION_NAME = "SistemaVentas";

const DOCUMENTOS_USUARIOS = ["DUI", "DNI", "Cedula", "Licencia", "Pasaporte", "Otro"];

const PRODUCTO_UNIDAD = ["unidad", "Libra", "Kilogramo", "Caja", "Paquete", "Lata", "Galon", "Botella", "Tira", "Sobre", "Bolsa", "saco", "Tarjeta", "Otro"];

//Relacionadas con la moneda del país
const MONEDA_SIMBOLO = "$";
const MONEDA_NOMBRE = "COL";
const MONEDA_DECIMAL = "2";
const MONEDA_SEPARADOR_MILLAR = ".";
const MONEDA_SEPARADOR_DECIMAL = ",";

const CAMPO_OBLIGATORIO = '&nbsp; <i class="fas fa-edit"> </i> &bnsp;';

date_default_timezone_set("America/Bogota");

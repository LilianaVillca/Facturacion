<?php
include_once("../modelo/conexion.php");

$modelo = new Conexion();

if (isset($_GET["accion"])) {
    $accion = $_GET["accion"];

    switch ($accion) {
        case "crear":
            if (isset($_POST["id"], $_POST["nombre"], $_POST["tipo"], $_POST["anio"], $_POST["profe"])) {
                $carrera = $_POST["id"];
                $nombre = $_POST["nombre"];
                $tipo = $_POST["tipo"];
                $anio = $_POST["anio"];
                $profe = $_POST["profe"];

                exit();
            }else{
                echo "faltan parametros";
            }
            break;

        
    }
}




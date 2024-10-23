<?php
require_once("../modelo/conexion.php");
$usuario = new Conexion();
$usuario->cerrarSesion();
// Redirigir al usuario a la página de inicio
header("Location: ../index.php");
exit();
?>


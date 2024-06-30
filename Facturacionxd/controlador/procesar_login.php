<?php
session_start();
include_once '../modelo/conexion.php';

$modelo = new conexion();

// Validar credenciales
$permiso = $modelo->procesarInicioSesion($_POST['usuario'], $_POST['correo'], $_POST['contrasena']);

if ($permiso !== null) {
    $_SESSION["autentificado"] = true;
    $_SESSION["rol"] = $permiso;

    if ($permiso == "1") {
        header("Location: ../vista/admin.php");

    } elseif($permiso == "0") {
        header("Location: ../vista/cliente.php");
        exit();
    }

} else {
    // Credenciales inválidas, redirigir a la página de inicio con mensaje de error
    $_SESSION["autentificado"] = false;
    header("Location: ../index.php?errorusuario=si");
    exit();
}
?>
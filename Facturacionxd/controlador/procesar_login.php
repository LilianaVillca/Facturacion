<?php
session_start();
include_once '../modelo/conexion.php';

$modelo = new conexion();

// Validar credenciales
$permiso = $modelo->procesarInicioSesion($_POST['usuario'], $_POST['correo'], $_POST['contrasena']);
// $id_usuario = $modelo->obtenerIdUsuario($_POST['usuario']);

if ($permiso !== null) {

    // Obtener el nombre del usuario
    $nombreUsuario = $modelo->obtenerNombreUsuario($_POST['usuario']);

    // Autenticación exitosa, redirigir según el permiso del usuario
    $_SESSION["autentificado"] = true;
    $_SESSION["rol"] = $permiso;
    $_SESSION["nombre_usuario"] = $nombreUsuario; // Guardar el nombre en la sesión

    if ($permiso == "1") {
        header("Location: ../vista/admin.php");
    } elseif ($permiso == "0") {
        header("Location: ../vista/facturas2.php");
        exit();
    }
} else {
    // Credenciales inválidas, redirigir a la página de inicio con mensaje de error
    $_SESSION["autentificado"] = false;
    header("Location: ../index.php?errorusuario=si");
    exit();
}

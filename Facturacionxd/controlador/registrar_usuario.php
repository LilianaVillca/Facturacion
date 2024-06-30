<?php
session_start();
include_once '../modelo/conexion.php';

$modelo = new Conexion();

$usuario = $_POST['usuario'];
$correo = $_POST['correo'];
$contrasena = $_POST['contrasena'];
$confirmarContra = $_POST['confirmarContra'];

if ($contrasena === $confirmarContra) {
    $registroExitoso = $modelo->registrarUsuario($usuario, $correo, $contrasena);

    if ($registroExitoso) {
        // Registro exitoso, redirigir a la página de login
        header("Location: ../index.php?registro=exitoso");
    } 
} else {
    // Las contraseñas no coinciden, redirigir a la página de registro con mensaje de error
    header("Location: ../index.php?errorcontrasena=si");
}
?>

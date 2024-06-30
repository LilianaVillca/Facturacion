<?php
class Conexion
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli("localhost:3307", "root", "Eva2024", "facturacion");
    }
    ///////////////////////////////INGRESO DE USUARIO ///////////////////////////
    public function procesarInicioSesion($usuario, $correo, $contrasena) {
        $consulta = "SELECT * FROM usuario WHERE nomUsuario = ? AND email = ? AND password = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("sss", $usuario,$correo, $contrasena);
        $stmt->execute();
        $resultado = $stmt->get_result();
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row["rol"]; // Devolver el rol del usuario
        } else {
            return null; // Devolver null si las credenciales son inválidas
        }
    }
    ////////////////////////////////  REGISTRAR USUARIO /////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function registrarUsuario($usuario, $correo, $contrasena) {
        $sql = "INSERT INTO usuario (nombre_usuario, correo, contrasena, rol) VALUES ('$usuario', '$correo', '$contrasena', 'cliente')";
        $result = $this->conexion->query($sql);
        return $result;
    }


    public function obtenerIdUsuario($usuario) {
        // Consulta SQL para obtener el ID de usuario a partir del nombre de usuario
        $consulta = "SELECT id_Usuario FROM usuario WHERE nomUsuario = ?";
    
        // Preparar la consulta
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("s", $usuario); // "s" indica que se trata de una cadena (nombre de usuario)
    
        // Ejecutar consulta
        $stmt->execute();
    
        // Obtener resultado
        $resultado = $stmt->get_result();
    
        // Verificar si se encontraron resultados
        if ($resultado->num_rows > 0) {
            $row = $resultado->fetch_assoc();
            return $row["id_Usuario"]; // Devolver el ID de usuario
        } else {
            return null; // Devolver null si no se encuentra el ID de usuario
        }
    }
    

    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // ACIONES DEL ADMINISTRADOR //
    // GESTION DE USUARIOS //
    
    public function obtener_facturas(){
        $sql="SELECT * FROM factura";
        // Ejecutar la consulta
        $result = $this->conexion->query($sql);
        $facturas = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $facturas[] = $row;
            }
            return $facturas;
        } else {
            return array();
        }

    }

}


?>

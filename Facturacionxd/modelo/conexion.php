<?php
class Conexion
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli("localhost:3309", "root", "", "facturacion");
    }
    ///////////////////////////////INGRESO DE USUARIO ///////////////////////////
    public function procesarInicioSesion($usuario, $correo, $contrasena)
    {
        $consulta = "SELECT * FROM usuario WHERE nomUsuario = ? AND email = ? AND password = ?";
        $stmt = $this->conexion->prepare($consulta);
        $stmt->bind_param("sss", $usuario, $correo, $contrasena);
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

    public function registrarUsuario($usuario, $correo, $contrasena)
    {
        $sql = "INSERT INTO usuario (nombre_usuario, correo, contrasena, rol) VALUES ('$usuario', '$correo', '$contrasena', 'cliente')";
        $result = $this->conexion->query($sql);
        return $result;
    }

    
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    // ACIONES DEL ADMINISTRADOR //
    // GESTION DE USUARIOS //

    public function obtenerIdUsuario($usuario)
    {
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
    public function obtener_facturas()
    {
        $sql = "SELECT f.*, c.nombre AS nombre_cliente 
            FROM factura f
            join usuario u on u.id_usuario = f.id_usuario
            JOIN cliente c ON u.id_usuario = c.id_cliente";
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
    public function obtener_factura($id_factura)
    {
        $sql = "SELECT * FROM factura WHERE id_factura = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_factura);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function obtener_usuarios()
    {
        $sql = "SELECT * FROM usuario";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $id_factura);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return null;
        }
    }
    public function obtener_clientes()
    {
        $sql = "SELECT * FROM cliente";
        $stmt = $this->conexion->prepare($sql);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC);
        } else {
            return [];
        }
    }
    public function obtenerNombreUsuario($usuario)
    {
        $sql = "SELECT nomUsuario FROM usuario WHERE nomUsuario = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("s", $usuario);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['nomUsuario'];
        } else {
            return null;
        }
    }
    //////////////////////////////////////////////////// ACCIONES PARA CREAR FACTURA ///////////////////////////////////////////////////////////////
    public function obtenerClientePorId($idCliente) {
        $stmt = $this->conexion->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }
    public function guardarFacturas()
    {
        $sql = "INSER INTO factura ............ A TERMINAR";
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
    //////////////////////////////////////////////////// Método para cerrar la sesión///////////////////////////////////////////////////////////
    public static function cerrarSesion()
    {
        // Iniciar sesión para acceder a la variable $_SESSION
        session_start();

        // Destruir la sesión
        session_destroy();
    }
}

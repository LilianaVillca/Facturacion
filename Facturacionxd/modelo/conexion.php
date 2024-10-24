<?php
class Conexion
{
    private $conexion;

    public function __construct()
    {
        $this->conexion = new mysqli("localhost:3309", "root", "", "facturaciondb");
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

    public function obtener_productos()
    {
        $sql = "SELECT p.id_producto, p.descripcion_producto, p.precio_producto, c.nombre AS nombre_categoria
                FROM producto p
                JOIN categorias c ON p.categorias_id = c.id";
        $result = $this->conexion->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result && $result->num_rows > 0) {
            // Crear un array para almacenar los productos
            $productos = array();

            // Recorrer los resultados y agregarlos al array
            while ($row = $result->fetch_assoc()) {
                $productos[] = $row;
            }

            return $productos;
        } else {
            // Si no hay resultados, devuelve un array vacío
            return array();
        }
    }

    public function obtener_clientes()
    {
        $sql = "SELECT * FROM cliente";
        $result = $this->conexion->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result && $result->num_rows > 0) {
            // Crear un array para almacenar los productos
            $clientes = array();

            // Recorrer los resultados y agregarlos al array
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }

            return $clientes;
        } else {
            // Si no hay resultados, devuelve un array vacío
            return array();
        }
    }

    public function productos_mas_vendidos()
    {
        $sql = "SELECT * FROM ";
        $result = $this->conexion->query($sql);

        // Verificar si la consulta fue exitosa
        if ($result && $result->num_rows > 0) {
            // Crear un array para almacenar los productos
            $clientes = array();

            // Recorrer los resultados y agregarlos al array
            while ($row = $result->fetch_assoc()) {
                $clientes[] = $row;
            }

            return $clientes;
        } else {
            // Si no hay resultados, devuelve un array vacío
            return array();
        }
    }

}


?>

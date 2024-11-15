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

    public function obtenerClientePorDni($dni)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM cliente WHERE dni = ?");
        $stmt->bind_param("i", $dni);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerProductoPorId($producto)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM producto WHERE id_producto = ?");
        $stmt->bind_param("i", $producto);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function obtenerProductos($idProducto)
    {
        $sql = "SELECT nombre, domicio, celular FROM cliente WHERE id_cliente = ?";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();

        // Si encuentra el cliente, devuelve sus datos
        if ($result->num_rows > 0) {
            echo json_encode($result->fetch_assoc());
        } else {
            echo json_encode(["error" => "Cliente no encontrado"]);
        }
    }
    ////////////////////////////////////////////////////////  guardar factura //////////////////////////////////////////////////////////////////
    // Obtener el ID del cliente a partir del nombre o CUIL/CUIT
    public function obtenerIdCliente($dni)
    {
        $query = "SELECT id_cliente FROM cliente WHERE dni = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("i", $dni);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['id_cliente'];
    }

    // Guardar factura en la base de datos y devolver el ID de la factura
    public function guardarFactura($idCliente, $subTotal, $montoImpuestos, $totalFinal)
    {
        $query = "INSERT INTO factura (id_usuario, subtotal , montoImpuesto,  total) 
              VALUES (?,?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iddd", $idCliente, $subTotal, $montoImpuestos, $totalFinal);
        $stmt->execute();
        return $stmt->insert_id;
    }

    // Guardar detalle de la factura
    public function guardarDetalleFactura($idFactura, $idProducto, $cantidad, $precio, $total, $formaPago)
    {
        $query = "INSERT INTO detalle_factura (id_factura, id_producto, cantidad_producto, precio_producto, total_producto, forma_pago) 
              VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iiidds", $idFactura, $idProducto, $cantidad, $precio, $total, $formaPago);
        $stmt->execute();
    }
    // Obtener el ID del producto basado en el código del producto
    public function obtenerIdProducto($codigoProducto)
    {
        $query = "SELECT id_producto FROM producto WHERE codigo_producto = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $codigoProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['id_producto'];
    }


    //////////////////////////////////////////////////// Método para cerrar la sesión///////////////////////////////////////////////////////////
    public static function cerrarSesion()
    {
        // Iniciar sesión para acceder a la variable $_SESSION
        session_start();

        // Destruir la sesión
        session_destroy();
    }


    // ////////////////////////////// metodos Brisa //////////////////////////////////////////

    ///////otra cosaa eeeee
    public function obtenerClientePorId($idCliente)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM clientes WHERE id_cliente = ?");
        $stmt->bind_param("i", $idCliente);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

   

    ////////////////////mio
    public function obtener_productos()
    {
        $sql = "SELECT p.id_producto, p.codigo_producto, p.descripcion_producto, p.precio_producto, c.nombre AS nombre_categoria
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


    
// Nota de Credito---- realizado por Eva...jeje // Iniciar transacción
           
         public function obtenerNotaCredito($id_notaCredito, $numeroFactura, $idFactura, $monto, $motivo, $fecha) {
            try {
                // Iniciar la transacción
                $this->conexion->beginTransaction();
        
                // Insertar la nota de crédito
                $stmt = $this->conexion->prepare("INSERT INTO nota_credito (id_notacredito, numerofactura, id_factura, monto, motivo, fecha) 
                                            VALUES (:id_notacredito, :numerofactura, :id_factura, :monto, :motivo, :fecha)");
                $stmt->bindParam(":id_notacredito", $id_notaCredito);
                $stmt->bindParam(":numerofactura", $numeroFactura);
                $stmt->bindParam(":id_factura", $idFactura);
                $stmt->bindParam(":monto", $monto);
                $stmt->bindParam(":motivo", $motivo);
                $stmt->bindParam(":fecha", $fecha);
                $stmt->execute();
        
                // Actualizar la factura original como anulada o dada de baja
                $stmt = $this->db->prepare("UPDATE facturas SET nota_credito = 1 WHERE id = :idFactura");
                $stmt->bindParam(":idFactura", $idFactura);
                $stmt->execute();
        
                // Confirmar la transacción
                $this->db->commit();
                return true;
            } catch (Exception $e) {
                // Revertir cambios en caso de error
                $this->db->rollBack();
                throw $e;
            }
        }
    }
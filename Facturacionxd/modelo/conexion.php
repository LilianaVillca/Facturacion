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
        // $sql = "SELECT f.*, c.nombre AS nombre_cliente  FROM factura f
            // JOIN cliente c ON f.id_cliente = c.id_cliente ORDER BY fecha DESC "; // ORDER BY fecha DESC, hora DESC
        // Ejecutar la consulta
        $sql = "
        SELECT 
            f.id_factura, nc.id_nota_credito,
            COALESCE(nc.tipo_factura, f.tipoFactura) AS tipo_comprobante,
            COALESCE(nc.fecha, f.fecha) AS fecha,
            COALESCE(nc.hora, f.hora) AS hora,
            c.nombre AS nombre_cliente,
            COALESCE(nc.total, f.total) AS total
        FROM factura f
        JOIN cliente c ON f.id_cliente = c.id_cliente
        LEFT JOIN nota_credito nc ON f.id_factura = nc.id_factura
        ORDER BY fecha DESC, hora DESC
    ";
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
        // $sql = "SELECT f.*, c.nombre AS nombre_cliente 
        //     FROM factura f
        //     JOIN cliente c ON f.id_cliente = c.id_cliente WHERE id_factura = ?";
        $sql = "
        SELECT 
            f.id_factura,
            nc.id_nota_credito,
            COALESCE(nc.tipo_factura, f.tipoFactura) AS tipo_comprobante,
            COALESCE(nc.fecha, f.fecha) AS fecha,
            COALESCE(nc.hora, f.hora) AS hora,
            c.nombre AS nombre_cliente,
            COALESCE(nc.total, f.total) AS total,
            nc.motivo AS motivo_nota_credito -- Ejemplo: incluir campo adicional para notas de crédito
        FROM factura f
        JOIN cliente c ON f.id_cliente = c.id_cliente
        LEFT JOIN nota_credito nc ON f.id_factura = nc.id_factura
        WHERE f.id_factura = ?
    ";
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
    public function obtener_detalle_factura($id_factura)
    {
        // $sql = "SELECT * FROM detalle_factura WHERE id_factura = ?";
        $sql = "SELECT df.id_detalle_factura, df.id_factura, df.id_producto,
        p.descripcion_producto, df.cantidad_producto, df.precio_producto, df.total_producto,
        df.forma_pago FROM detalle_factura AS df INNER JOIN producto AS p ON df.id_producto = p.id_producto
        WHERE df.id_factura = ?";
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
    public function crearCliente($nombre, $apellido, $dni, $domicilio, $correo, $tipoCliente)
    {
        $sql = "INSERT INTO cliente (nombre, apellido, dni, domicilio, correo, tipo_cliente) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([$nombre, $apellido, $dni, $domicilio, $correo, $tipoCliente]);
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
    public function guardarFactura($idCliente, $tipoFactura, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal)
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date('Y-m-d'); // Fecha actual
        $hora = date('H:i:s'); // Hora actual

        $query = "INSERT INTO factura (id_cliente, fecha, hora, tipoFactura, subtotal, porcentajeImpuesto, montoImpuesto, total) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("isssdddd", $idCliente, $fecha, $hora, $tipoFactura, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal);
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
        $query = "SELECT id_producto FROM producto WHERE id_producto = ?";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("s", $codigoProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row['id_producto'];
    }
    //////////////////////////////////////////////////// Método para guardar Nota de credito ///////////////////////////////////////////////////////////

    public function guardarNotaCredito($cliente, $motivo, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal, $idFactura, $tipoFactura )
    {
        date_default_timezone_set('America/Buenos_Aires');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $query = "INSERT INTO nota_credito (id_cliente,id_factura, fecha, hora, motivo, subtotal, porcentaje_impuesto, monto_impuesto, total, tipo_factura) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iisssdddds", $cliente, $idFactura, $fecha, $hora, $motivo, $subTotal, $porcentajeImpuestos, $montoImpuestos, $totalFinal, $tipoFactura);
        $stmt->execute();
        return $stmt->insert_id;
    }

    public function guardarDetalleNotaCredito($idNotaCredito, $idProducto, $descripcion, $cantidad, $precio, $total, $formaPago)
    {
        $query = "INSERT INTO detalle_nota_credito (id_nota_credito, id_producto, descripcion, cantidad, precio, total, forma_pago) 
                      VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->conexion->prepare($query);
        $stmt->bind_param("iisddds", $idNotaCredito, $idProducto, $descripcion, $cantidad, $precio, $total, $formaPago);
        $stmt->execute();
    }
    // public function obtenerNotaCredito(){
    //     $sql = "SELECT f.id_factura, f.tipoFactura, f.fecha, f.hora, f.nombre_cliente, f.total, CASE 
    //     WHEN nc.id_factura IS NOT NULL THEN 1 
    //     ELSE 0  END AS tiene_nota_credito FROM facturas f LEFT JOIN notas_credito nc ON f.id_factura = nc.id_factura;"; // un inert con id de factura nabien
    //    // Ejecutar la consulta
    //    $result = $this->conexion->query($sql);
    //    $facturas = array();

    //    if ($result->num_rows > 0) {
    //        while ($row = $result->fetch_assoc()) {
    //            $facturas[] = $row;
    //        }
    //        return $facturas;
    //    } else {
    //        return array();
    //    }
    // }

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
}

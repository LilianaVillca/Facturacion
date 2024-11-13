

<?php
include_once("../modelo/conexion.php");

class NotaCredito {
    private $model;

    
    public function crearNotaCredito() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $idFactura = $_POST['id_factura'];
            $monto = $_POST['monto'];
            $motivo = $_POST['motivo'];

            try {
                $this->model->crearNotaCredito($idFactura, $monto, $motivo);
                header("../modelo/conexion.php?accion=anular&id=nota_credito_creada");
                exit;
            } catch (Exception $e) {
                header("Location: /facturas?error=" . urlencode($e->getMessage()));
                exit;
            }
        }
    }
}


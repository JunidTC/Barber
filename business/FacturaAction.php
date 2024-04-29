<?php

include '../business/FacturaBusiness.php';
include '../business/ServicioBusiness.php';
include '../business/TarifaBusiness.php';
include '../business/MetodoPagoBusiness.php';
include '../business/FacturaDetalleBusiness.php';
include '../business/ImpuestoVentaBusiness.php';
include '../business/CreditoBusiness.php';
include '../business/LogicBusiness/Funciones.php';



if (isset($_POST['delete'])) {
   
    if (isset($_POST['idFactura']) && isset($_POST['idDetalleFactura'])) {
        $facturaid = $_POST['idFactura'];
        $detalleFacturaid = $_POST['idDetalleFactura'];
        $detalleFacturaBusiness = new FacturaDetalleBusiness();
        $result =$detalleFacturaBusiness->deleteTBDetalleTFactura($detalleFacturaid);
        $facturaBusiness = new FacturaBusiness();
        $result = $facturaBusiness->deleteTBFactura($facturaid);

        if ($result == 1) {
            header("location: ../view/FacturaView.php?success=deleted");
        } else {
            header("location: ../view/FacturaView.php?error=dbError");
        }
    } else {
        header("location: ../view/FacturaView.php?error=error");
    }
} else if (isset($_POST['create'])) {
 
    $servicioBusiness = new ServicioBusiness();
    $tarifaBusiness = new TarifaBusiness();
    $impuestoVentaBusiness = new ImpuestoVentaBusiness();
    $metodoPagoBusiness = new MetodoPagoBusiness();
    $idTarifa = $servicioBusiness->getTBServicioById($_POST['servicios']['idServicio'])->getTarifaId();
    $tarifa = $tarifaBusiness->getTBTarifaById($idTarifa)->getMonto();
    $impuestoVenta = $impuestoVentaBusiness->getTBImpuestoVentaById($_POST['impuestoVentas']['idimpuestoventa'])->getPorcentaje();
    $funciones = new Funciones();
    $monto = $funciones->montoTotal($_POST['cantidadServicios'], $tarifa);
    $montoTotal = $funciones->montoTotalConImpuesto($monto, $impuestoVenta);

    if (isset($_POST['clientes']) && isset($_POST['impuestoVentas']) && isset($_POST['metodoPagos']) && isset($_POST['fecha'])) {

        $clienteid = $_POST['clientes']['idcliente'];
        $activo = 1;
        $fecha = $_POST['fecha'];
        $impuestoId = $_POST['impuestoVentas']['idimpuestoventa'];
        $metodoPago = $_POST['metodoPagos']['idmetodopago'];
        $idMetodoPago = $metodoPagoBusiness->getTBMetodoPagoByNombre($metodoPago)->getId();
      

        if (strlen($clienteid) > 0 && strlen($impuestoId) > 0 && strlen($montoTotal) > 0 && strlen($monto) > 0) {
            $factura = new Factura(0, $clienteid, $impuestoId, $montoTotal, $monto, $fecha, $activo, $idMetodoPago);

            $facturaBusiness = new FacturaBusiness();
            $result = $facturaBusiness->insertTBFactura($factura);

            $facturaDetalleBusiness = new FacturaDetalleBusiness();
            $nuevaFacturaId = $facturaBusiness->getLastFactura()->getFacturaId();
            $montoTotalFactura = $facturaBusiness->getLastFactura()->getMontoTotal();
            $facturaDetalle = new DetalleFactura($nuevaFacturaId, $_POST['servicios']['idServicio'], $_POST['cantidadServicios'], 0, 1);
            $facturaDetalleBusiness->insertTBDetalleFactura($facturaDetalle);

            if ( !empty($_POST['creditosDias']) ) {
               
                $creditoBusiness = new CreditoBusiness();
                $fechaLimite = date("Y-m-d",strtotime($fecha. "+ ". $_POST['creditosDias'] ." days")); 
                $credito = new Credito(0, $nuevaFacturaId, $fechaLimite, 1, 1,$montoTotalFactura);
                
                $creditoBusiness->insertTBCredito($credito);
                 
            }

            if ($result == 1) {
                header("location: ../view/InsertarNuevoServicio.php?success=inserted&facturaId=" . $nuevaFacturaId);
            } else {
                header("location: ../view/DetalleFacturaView.php?error=dbError");
            }
        } else {
            header("location: ../view/DetalleFacturaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/DetalleFacturaView.php?error=dbError");
    }
}

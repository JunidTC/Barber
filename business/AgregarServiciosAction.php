<?php

include '../business/FacturaBusiness.php';
include '../business/ServicioBusiness.php';
include '../business/TarifaBusiness.php';
include '../business/MetodoPagoBusiness.php';
include '../business/FacturaDetalleBusiness.php';
include '../business/ImpuestoVentaBusiness.php';
include '../business/CreditoBusiness.php';
include '../business/LogicBusiness/Funciones.php';

 if (isset($_POST['create'])) {

    $facturaBusiness = new FacturaBusiness();
    $servicioBusiness = new ServicioBusiness();
    $tarifaBusiness = new TarifaBusiness();
    $impuestoVentaBusiness = new ImpuestoVentaBusiness();
    $metodoPagoBusiness = new MetodoPagoBusiness();
    $idTarifa = $servicioBusiness->getTBServicioById($_POST['servicios']['idServicio'])->getTarifaId();
    $tarifa = $tarifaBusiness->getTBTarifaById($idTarifa)->getMonto();
    $impuestoVenta = $impuestoVentaBusiness->getTBImpuestoVentaById($facturaBusiness->getFacturaById($_POST['idFactura'])->getImpuestoVenta())->getPorcentaje();
    $funciones = new Funciones();
    $monto = $funciones->montoTotal($_POST['cantidadServicios'], $tarifa);
    $montoTotal = $funciones->montoTotalConImpuesto($monto, $impuestoVenta);
    $factura = $facturaBusiness->getFacturaById($_POST['idFactura']);
    $metodoPago =  $metodoPagoBusiness->getTBMetodoPagoById($factura->getMetodoPago())->getNombre();
    $factura->setMonto($factura->getMonto() + $monto);
    $factura->setMontoTotal($factura->getMontoTotal() + $montoTotal);

    $facturaBusiness->updateTBFactura($factura);

    if($metodoPago == "credito"){
        $creditoBusiness = new CreditoBusiness();
        $credito = $creditoBusiness->getTBCreditoByIdFactura($_POST['idFactura']);
        $credito->setMontoCredito($credito->getMontoCredito() + $montoTotal);
        $creditoBusiness->updateTBCredito($credito);
    }

    if ( isset($_POST['servicios']['idServicio']) && isset($_POST['cantidadServicios']) && isset($_POST['idFactura'])) {

        
        $idServicio = $_POST['servicios']['idServicio'];
        $cantidadServicios = $_POST['cantidadServicios'];
      

        if ( strlen($idServicio) > 0 && strlen($cantidadServicios) > 0 ) {
          
            $facturaDetalleBusiness = new FacturaDetalleBusiness();
            $nuevaFacturaId = $_POST['idFactura'];
            $facturaDetalle = new DetalleFactura($nuevaFacturaId, $idServicio, $cantidadServicios, 0, 1);
            $result = $facturaDetalleBusiness->insertTBDetalleFactura($facturaDetalle);

         
            if ($result == 1) {
                header("location: ../view/InsertarNuevoServicio.php?success=inserted&facturaId=" . $nuevaFacturaId);
            } else {
                header("location: ../view/InsertarNuevoServicio.php?error=dbError&facturaId=" . $nuevaFacturaId);
            }
        } else {
            header("location: ../view/InsertarNuevoServicio.php?error=emptyField&facturaId=" . $nuevaFacturaId);
        }
    } else {
        header("location: ../view/InsertarNuevoServicio.php?error=dbError&facturaId=" . $nuevaFacturaId);
    }
}

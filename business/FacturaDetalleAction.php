<?php

include '../business/FacturaDetalleBusiness.php';
include '../business/FacturaBusiness.php';
include '../business/CreditoBusiness.php';



if (isset($_POST['update'])) {

    
    
    if (isset($_POST['idDetalleFactura']) && isset($_POST['facturas'])  && isset($_POST['servicios']) && isset($_POST['cantidadServicio'])) {
        $idDetalleFactura = $_POST['idDetalleFactura'];
        $facturaId = $_POST['facturas']['facturaId'];
        $servicioId = $_POST['servicios']['idServicio'];
        $cantidadServicio = $_POST['cantidadServicio'];
    
        
        if (strlen($idDetalleFactura) > 0 && strlen($facturaId) > 0 && strlen($servicioId) > 0  && strlen($cantidadServicio) > 0) {

            $facturaDetalle = new DetalleFactura($facturaId, $servicioId,  $cantidadServicio, $idDetalleFactura,1);

            $facturaDetalleBusiness = new FacturaDetalleBusiness();
          
            
            $result = $facturaDetalleBusiness->updateTBDetalleFactura($facturaDetalle);

            if ($result == 1) {
                header("location: ../view/DetalleFacturaView.php?success=updated");
            } else {
                header("location: ../view/DetalleFacturaView.php?error=dbError");
            }
        } else {
            header("location: ../view/DetalleFacturaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/DetalleFacturaView.php?error=error");
    }
} else if (isset($_POST['delete'])) {

    $facturaBusiness = new FacturaBusiness();
    $creditoBusiness = new CreditoBusiness();
    if (isset($_POST['idDetalleFactura'])) {

        $id = $_POST['idDetalleFactura'];
        $facturaDetalle = $facturaBusiness->getFacturaById($id); 
        $facturaDetalleBusiness = new FacturaDetalleBusiness();
        $idCredito = $creditoBusiness->foundTBCreditoByIdFactura($facturaDetalle->getFacturaId());

        if($idCredito != null){
            $creditoBusiness->deleteTBCredito($idCredito);
        }
        $facturaBusiness->deleteTBFactura($facturaDetalle->getFacturaId());
        $result = $facturaDetalleBusiness->deleteTBDetalleTFactura($id);

        if ($result == 1) {
            header("location: ../view/DetalleFacturaView.php?success=deleted");
        } else {
            header("location: ../view/DetalleFacturaView.php?error=dbError");
        }
    } else {
        header("location: ../view/DetalleFacturaView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar
    
    if ( isset($_POST['facturas'])  && isset($_POST['servicios']) && isset($_POST['cantidadServicio'])) {
        //recibir valores y guardar en variables 
        $facturaId = $_POST['facturas']['facturaId'];
        $servicioId = $_POST['servicios']['idServicio'];
        $cantidadServicio = $_POST['cantidadServicio'];
        
        //validando datos
        if ( strlen($facturaId) > 0 && strlen($servicioId) > 0  && strlen($cantidadServicio) > 0) {
            //creando objeto
            $facturaDetalle = new DetalleFactura($facturaId, $servicioId,  $cantidadServicio, 0,1);
            $facturaDetalleBusiness = new FacturaDetalleBusiness();

            $result = $facturaDetalleBusiness->insertTBDetalleFactura($facturaDetalle);

            if ($result == 1) {
                header("location: ../view/DetalleFacturaView.php?success=inserted");
            } else {
                header("location: ../view/DetalleFacturaView.php?error=dbError");
            }
        } else {
            header("location: ../view/DetalleFacturaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/DetalleFacturaView.php?error=error");
    }
}

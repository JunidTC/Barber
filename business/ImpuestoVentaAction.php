<?php

include 'ImpuestoVentaBusiness.php';


if (isset($_POST['update'])) {
       
    

    if (isset($_POST['impuestoventaid']) && isset($_POST['impuestoventaporcentaje']) && isset($_POST['impuestoventafechaactualizacion'])) {
        
        $porcentaje = $_POST['impuestoventaporcentaje'];
        $fechaactualizacion = $_POST['impuestoventafechaactualizacion'];
        $id = $_POST['impuestoventaid'];
        

        if (strlen($porcentaje) > 0 && strlen($fechaactualizacion) > 0) {

            $impuestoventa = new ImpuestoVenta($id, $porcentaje, $fechaactualizacion, 1);
            
            $impuestoVentaBusiness = new ImpuestoVentaBusiness();

            $result = $impuestoVentaBusiness->updateTBImpuestoVenta($impuestoventa);

            if ($result == 1) {
                header("location: ../view/ImpuestoVentaView.php?success=updated");
            } else {
                header("location: ../view/ImpuestoVentaView.php?error=dbError");
            }
        } else {
            header("location: ../view/ImpuestoVentaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ImpuestoVentaView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivado'])){
    if (isset($_POST['impuestoventaid']) && isset($_POST['impuestoventaporcentaje']) && isset($_POST['impuestoventafechaactualizacion'])) {

        $porcentaje = $_POST['impuestoventaporcentaje'];
        $fechaactualizacion = $_POST['impuestoventafechaactualizacion'];
        $activo = 1 ; // si el check fue marcado, será 1, caso contrario 0
        $id = $_POST['impuestoventaid'];
        if(!isset($_POST['impuestoventaactivo'])){
            $activo = 0;
        }


        if (strlen($porcentaje) > 0 && strlen($fechaactualizacion) > 0) {

            $impuestoventa = new ImpuestoVenta($id, $porcentaje, $fechaactualizacion, $activo);

            $impuestoVentaBusiness = new ImpuestoVentaBusiness();

            $result = $impuestoVentaBusiness->updateTBImpuestoVenta($impuestoventa);

            if ($result == 1) {
                header("location: ../view/ImpuestoVentaView.php?success=updated");
            } else {
                header("location: ../view/ImpuestoVentaView.php?error=dbError");
            }
        } else {
            header("location: ../view/ImpuestoVentaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ImpuestoVentaView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['impuestoventaid'])) {

        $id = $_POST['impuestoventaid'];

        $impuestoVentaBusiness = new ImpuestoVentaBusiness();
        $result = $impuestoVentaBusiness->deleteTBImpuestoVenta($id);

        if ($result == 1) {
            header("location: ../view/ImpuestoVentaView.php?success=deleted");
        } else {
            header("location: ../view/ImpuestoVentaView.php?error=dbError");
        }
    } else {
        header("location: ../view/ImpuestoVentaView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['impuestoventaporcentaje']) && isset($_POST['impuestoventafechaactualizacion'])) {
        //recibir valores y guardar en variables 
        $porcentaje = $_POST['impuestoventaporcentaje'];
        $fechaactualizacion = $_POST['impuestoventafechaactualizacion'];

        //validando datos
        if (strlen($porcentaje) > 0 && strlen($fechaactualizacion) > 0) {
            //creando objeto
            $impuestoventa = new ImpuestoVenta(0, $porcentaje, $fechaactualizacion, 1);

            $impuestoVentaBusiness = new ImpuestoVentaBusiness();

            $result =  $impuestoVentaBusiness->insertTBImpuestoVenta($impuestoventa);

            if ($result == 1) {
                header("location: ../view/ImpuestoVentaView.php?success=inserted");
            } else {
                header("location: ../view/ImpuestoVentaView.php?error=dbError");
            }
        } else {
            header("location: ../view/ImpuestoVentaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ImpuestoVentaView.php?error=error");
    }
}

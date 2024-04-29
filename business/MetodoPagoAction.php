<?php

include './MetodoPagoBusiness.php';



if (isset($_POST['update'])) {

    if (isset($_POST['metodopagoid']) && isset($_POST['metodopagonombre'])  && isset($_POST['metodopagodescripcion'])) {
        $nombre = $_POST['metodopagonombre'];
        $descripcion = $_POST['metodopagodescripcion'];
        $activo = isset($_POST['metodopagoactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
        $id = $_POST['metodopagoid'];


        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            $metodoPago = new MetodoPago($id, $nombre,  $descripcion, 1);

            $metodoPagoBusiness = new MetodoPagoBusiness();

            $result = $metodoPagoBusiness->updateTBMetodoPago($metodoPago);

            if ($result == 1) {
                header("location: ../view/MetodoPagoView.php?success=updated");
            } else {
                header("location: ../view/MetodoPagoView.php?error=dbError");
            }
        } else {
            header("location: ../view/MetodoPagoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/MetodoPagoView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivado'])){
    if (isset($_POST['metodopagoid']) && isset($_POST['metodopagonombre'])  && isset($_POST['metodopagodescripcion'])) {
        $nombre = $_POST['metodopagonombre'];
        $descripcion = $_POST['metodopagodescripcion'];
        $activo =1  ; // si el check fue marcado, será 1, caso 
        $id = $_POST['metodopagoid'];
        if(!isset($_POST['metodopagoactivo'])){
            $activo = 0;
        }


        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {

            $metodoPago = new MetodoPago($id, $nombre,  $descripcion, $activo);

            $metodoPagoBusiness = new MetodoPagoBusiness();

            $result = $metodoPagoBusiness->updateTBMetodoPago($metodoPago);

            if ($result == 1) {
                header("location: ../view/MetodoPagoView.php?success=updated");
            } else {
                header("location: ../view/MetodoPagoView.php?error=dbError");
            }
        } else {
            header("location: ../view/MetodoPagoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/MetodoPagoView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['metodopagoid'])) {

        $id = $_POST['metodopagoid'];

        $metodoPagoBusiness = new MetodoPagoBusiness();
        $result = $metodoPagoBusiness->deleteTBMetodoPago($id);

        if ($result == 1) {
            header("location: ../view/MetodoPagoView.php?success=deleted");
        } else {
            header("location: ../view/MetodoPagoView.php?error=dbError");
        }
    } else {
        header("location: ../view/MetodoPagoView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['metodopagonombre']) && isset($_POST['metodopagodescripcion'])) {
        //recibir valores y guardar en variables 
        $nombre = $_POST['metodopagonombre'];
        $descripcion = $_POST['metodopagodescripcion'];

        //validando datos
        if (strlen($nombre) > 0 && strlen($descripcion) > 0) {
            //creando objeto
            $metodoPago = new MetodoPago(0, $nombre,  $descripcion, 1);

            $metodoPagoBusiness = new MetodoPagoBusiness();

            $result =  $metodoPagoBusiness->insertTBMetodoPago($metodoPago);

            if ($result == 1) {
                header("location: ../view/MetodoPagoView.php?success=inserted");
            } else {
                header("location: ../view/MetodoPagoView.php?error=dbError");
            }
        } else {
            header("location: ../view/MetodoPagoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/MetodoPagoView.php?error=error");
    }
}

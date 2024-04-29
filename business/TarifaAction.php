<?php

include './TarifaBusiness.php';


if (isset($_POST['update'])) {

    if (isset($_POST['tarifaid']) && isset($_POST['tarifafecha']) && isset($_POST['tarifamonto'])  ) {

        $fecha = $_POST['tarifafecha'];
        $monto = $_POST['tarifamonto'];
        $activo = isset($_POST['tarifaactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso contrario 0
        $id = $_POST['tarifaid'] ;
       
        
        if (strlen($fecha) > 0 && strlen($monto) > 0 ) {
        
            $tarifa = new Tarifa($id,$fecha,$monto, 1 );

            $tarifaBusiness = new TarifaBusiness();

            $result = $tarifaBusiness->updateTBTarifa($tarifa );

                if ($result == 1) {
                    header("location: ../view/TarifaServicioView.php?success=updated");
                } else {
                    header("location: ../view/TarifaServicioView.php?error=dbError");
                }
        } else {
            header("location: ../view/TarifaServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/TarifaServicioView.php?error=dbError");
    }
}else if (isset($_POST['updateDesactivado'])) {
    if (isset($_POST['tarifaid']) && isset($_POST['tarifafecha']) && isset($_POST['tarifamonto'])  ) {

        $fecha = $_POST['tarifafecha'];
        $monto = $_POST['tarifamonto'];
        $activo =1; // si el check fue marcado, será 1, caso contrario 0
        $id = $_POST['tarifaid'] ;
        if(!isset($_POST['tarifaactivo'])){
            $activo = 0;
        }
        
        if (strlen($fecha) > 0 && strlen($monto) > 0 ) {
        
            $tarifa = new Tarifa($id,$fecha,$monto, $activo );

            $tarifaBusiness = new TarifaBusiness();

            $result = $tarifaBusiness->updateTBTarifa($tarifa);

                if ($result == 1) {
                    header("location: ../view/TarifaServicioView.php?success=updated");
                } else {
                    header("location: ../view/TarifaServicioView.php?error=dbError");
                }
        } else {
            header("location: ../view/TarifaServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/TarifaServicioView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['tarifaid'])) {

        $id = $_POST['tarifaid'];

        $tarifaBusiness = new TarifaBusiness();
        $result = $tarifaBusiness->deleteTBTarifa($id);

        if ($result == 1) {
            header("location: ../view/TarifaServicioView.php?success=deleted");
        } else {
            header("location: ../view/TarifaServicioView.php?error=dbError");
        }
    } else {
        header("location: ../view/TarifaServicioView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['tarifafecha']) && isset($_POST['tarifamonto'])  ) {
        //recibir valores y guardar en variables 
        $fecha = $_POST['tarifafecha'];
        $monto = $_POST['tarifamonto'];
        
        //validando datos
        if (strlen($fecha) > 0 && strlen($monto) > 0 ) {
            //creando objeto
             $tarifa = new Tarifa(0,$fecha,$monto, 1 );

                $tarifaBusiness = new TarifaBusiness();

                $result =  $tarifaBusiness->insertTBTarifa($tarifa );

                if ($result == 1) {
                    header("location: ../view/TarifaServicioView.php?success=inserted");
                } else {
                    header("location: ../view/TarifaServicioView.php?error=dbError");
                }
        } else {
            header("location: ../view/TarifaServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/TarifaServicioView.php?error=error");
    }
}




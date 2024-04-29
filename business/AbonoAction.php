<?php

include 'AbonoBusiness.php';
include '../business/CreditoBusiness.php';

if (isset($_POST['update'])) {

    if (isset($_POST['abonoId']) && isset($_POST['abonoFecha'])  && isset($_POST['abonoMonto']) && isset($_POST['creditoId'])) {
        $abonoId = $_POST['abonoId'];
        $abonoFecha = $_POST['abonoFecha'];
        $abonoMonto = $_POST['abonoMonto'];
        $creditoId = $_POST['creditoId'];


        if (strlen($abonoFecha) > 0 && strlen($abonoMonto) > 0 && strlen($creditoId) > 0) {

            $abonoBusiness = new AbonoBusiness();
            $abono = new Abono($abonoId, $abonoFecha, $abonoMonto, $creditoId);
            $result = $abonoBusiness->updateTBAbono($abono);

            if ($result == 1) {
                header("location: ../view/CreditoView.php?success=updated");
            } else {
                header("location: ../view/CreditoView.php?error=dbError");
            }
        } else {
            header("location: ../view/CreditoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/CreditoView.php?error=dbError");
    }
} else if (isset($_POST['delete'])) {


    if (isset($_POST['abonoId']) || isset($_POST['creditoId'])) {

        if (isset($_POST['abonoId'])) {
            $abonoId = $_POST['abonoId'];
            $abonoBusiness = new AbonoBusiness();
            $result = $abonoBusiness->deleteTBAbono($abonoId);
        } else if (isset($_POST['creditoId'])) {
            $creditoId = $_POST['creditoId'];
            $creditoBusiness = new CreditoBusiness();
            $result = $creditoBusiness->deleteTBCredito($creditoId);
        }

        if ($result == 1) {
            header("location: ../view/CreditoView.php?success=deleted");
        } else {
            header("location: ../view/CreditoView.php?error=dbError");
        }
    } else {
        header("location: ../view/CreditoView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar



    if (isset($_POST['abonoFecha'])  && isset($_POST['abono']) && isset($_POST['facturaId'])  && isset($_POST['montoCredito'])  &&  isset($_POST['fechaFactura'])  && isset($_POST['creditoId'])) {
        //recibir valores y guardar en variables
        $abonoFecha = $_POST['abonoFecha'];
        $abonoMonto = $_POST['abono'];
        $montoCredito = $_POST['montoCredito'];
        $creditoId = $_POST['creditoId'];
        $facturaId = $_POST['facturaId'];
        $fechaLimite = $_POST['fechaLimite'];


        //validando datos
        if (strlen($abonoMonto) > 0 && strlen($montoCredito) > 0) {
            //creando objeto

            $abonoBusiness = new AbonoBusiness();
            $abono = new Abono(0, $abonoFecha, $abonoMonto, $creditoId);
            
            //$result = $abonoBusiness->insertTBAbono($abono);

           
            if (($abonoMonto - $montoCredito) === 0) {
          
                $creditoBusiness = new CreditoBusiness();
                $credito = new Credito($creditoId, $facturaId, $fechaLimite, 0, 0, 0);
                
                $result = $creditoBusiness->updateTBCredito($credito);
            } else if (($montoCredito - $abonoMonto) < $montoCredito) {
               
                $residuo =  $montoCredito - $abonoMonto ;
                $creditoBusiness = new CreditoBusiness();
               
                $credito1 = new Credito($creditoId, $facturaId, $fechaLimite, 1, 1, $residuo);
                
                $result = $creditoBusiness->updateTBCredito($credito1);
            }


            if ($result == 1) {
                header("location: ../view/CreditoView.php?success=inserted");
            }else {
                header("location: ../view/CreditoView.php?error=dbError");
            }
        } else {
            header("location: ../view/CreditoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/CreditoView.php?error=error");
    }
}

<?php

include 'ClienteTipoBusiness.php';


if (isset($_POST['update'])) {

    

    if (isset($_POST['clientetipoid']) && isset($_POST['clientetipoperiodicidad'])  && isset($_POST['clientetipocancelacion']) && isset($_POST['clientetipoingresomensual']) && isset($_POST['clientetipopuntaje']) ) {
        
        
        $id = $_POST['clientetipoid'];
        $periodicidad = $_POST['clientetipoperiodicidad'];
        $cancelacion = $_POST['clientetipocancelacion'];
        $ingreso = $_POST['clientetipoingresomensual'];
        $puntaje = $_POST['clientetipopuntaje'];
        
       
        if (strlen($periodicidad) > 0 && strlen($cancelacion) > 0 && strlen($ingreso) > 0  && strlen($puntaje) > 0 ) {

            $clienteTipo = new ClienteTipo($id, $periodicidad,  $cancelacion , $ingreso, $puntaje, 1 );
            
                $clienteTipoBusiness = new ClienteTipoBusiness();

                $result = $clienteTipoBusiness->updateTBClienteTipo($clienteTipo);

                if ($result == 1) {
                    header("location: ../view/ClienteTipoView.php?success=updated");
                } else {
                    header("location: ../view/ClienteTipoView.php?error=dbError");
                }
        } else {
            header("location: ../view/ClienteTipoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteTipoView.php?error=dbError");
    }
}else if (isset($_POST['updateDesactivado']))  {

    if (isset($_POST['clientetipoid']) && isset($_POST['clientetipoperiodicidad'])  && isset($_POST['clientetipocancelacion']) && isset($_POST['clientetipoingresomensual']) && isset($_POST['clientetipopuntaje']) ) {
        $id = $_POST['clientetipoid'];
        $periodicidad = $_POST['clientetipoperiodicidad'];
        $cancelacion = $_POST['clientetipocancelacion'];
        $ingreso = $_POST['clientetipoingresomensual'];
        $puntaje = $_POST['clientetipopuntaje'];
        $activo = 1; // si el check fue marcado, será 1, caso 
        if(!isset($_POST['clientetipoactivo'])){
            $activo = 0;
        }
        if (strlen($periodicidad) > 0 && strlen($cancelacion) > 0 && strlen($ingreso) > 0  && strlen($puntaje) > 0 ) {

            $clienteTipo = new ClienteTipo($id, $periodicidad,  $cancelacion , $ingreso, $puntaje, $activo );

                $clienteTipoBusiness = new ClienteTipoBusiness();

                $result = $clienteTipoBusiness->updateTBClienteTipo($clienteTipo);

                if ($result == 1) {
                    header("location: ../view/ClienteTipoView.php?success=updated");
                } else {
                    header("location: ../view/ClienteTipoView.php?error=dbError");
                }
        } else {
            header("location: ../view/ClienteTipoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteTipoView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['clientetipoid'])) {

        $id = $_POST['clientetipoid'];

        $clienteTipoBusiness = new ClienteTipoBusiness();
        $result = $clienteTipoBusiness->deleteTBClienteTipo($id);

        if ($result == 1) {
            header("location: ../view/ClienteTipoView.php?success=deleted");
        } else {
            header("location: ../view/ClienteTipoView.php?error=dbError");
        }
    } else {
        header("location: ../view/ClienteTipoView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['clientetipoperiodicidad'])  && isset($_POST['clientetipocancelacion']) && isset($_POST['clientetipoingresomensual']) && isset($_POST['clientetipopuntaje']) ) {
        
        $periodicidad = $_POST['clientetipoperiodicidad'];
        $cancelacion = $_POST['clientetipocancelacion'];
        $ingreso = $_POST['clientetipoingresomensual'];
        $puntaje = $_POST['clientetipopuntaje'];
         
        //validando datos
        if (strlen($periodicidad) > 0 && strlen($cancelacion) > 0 && strlen($ingreso) > 0  && strlen($puntaje) > 0 ) {
            //creando objeto
             $clienteTipo = new ClienteTipo(0, $periodicidad,  $cancelacion , $ingreso, $puntaje, 1 );

                $clienteTipoBusiness = new ClienteTipoBusiness();

                $result =  $clienteTipoBusiness->insertTBClienteTipo($clienteTipo);

                if ($result == 1) {
                    header("location: ../view/ClienteTipoView.php?success=inserted");
                } else {
                    header("location: ../view/ClienteTipoView.php?error=dbError");
                }
        } else {
            header("location: ../view/ClienteTipoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteTipoView.php?error=error");
    }
}
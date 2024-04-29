<?php

include './ServicioBusiness.php';


if (isset($_POST['update'])) {

    
    if ( isset($_POST['servicioid'])  &&  isset($_POST['servicionombre']) && isset($_POST['serviciodescripcion']) && isset($_POST['tarifas']) && isset($_POST['servicioDuracion'])) {
        $nombre = $_POST['servicionombre'];
        $descripcion = $_POST['serviciodescripcion'];
        $activo = isset($_POST['servicioactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
        $id = $_POST['servicioid'] ;
        $tarifaId = $_POST['tarifas']['tarifaId'];
        $duracion = $_POST['servicioDuracion'];
        
        
       
        if (strlen($nombre) > 0 && strlen($descripcion) > 0 ) {
        

            $servicio = new Servicio($id, $nombre, $descripcion, 1, $tarifaId,$duracion);
           
                $servicioBusiness = new ServicioBusiness();

                $result =  $servicioBusiness->updateTBServicio($servicio);

                if ($result == 1) {
                    header("location: ../view/ServicioView.php?success=updated");
                } else {
                    header("location: ../view/ServicioView.php?error=dbError");
                }
        } else {
            header("location: ../view/ServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ServicioView.php?error=dbError");
    }
}else if (isset($_POST['updateDesactivado'])) {
    if (isset($_POST['servicionombre']) && isset($_POST['serviciodescripcion']) && isset($_POST['tarifaId']) && isset($_POST['servicioDuracion'])) {

        $nombre = $_POST['servicionombre'];
        $descripcion = $_POST['serviciodescripcion'];
        $activo = 1 ; // si el check fue marcado, será 1, caso 
        $id = $_POST['servicioid'] ;
        $tarifaId = $_POST['tarifaId'];
        if(!isset($_POST['servicioactivo'])){
            $activo = 0;
        }
        $duracion = $_POST['servicioDuracion'];
        
        if (strlen($nombre) > 0 && strlen($descripcion) > 0 ) {
            $servicio = new Servicio($id, $nombre, $descripcion, $activo , $tarifaId, $duracion);
            $servicioBusiness = new ServicioBusiness();
            $result =  $servicioBusiness->updateTBServicio($servicio);
            if ($result == 1) {
                header("location: ../view/ServicioView.php?success=updated");
            } else {
                header("location: ../view/ServicioView.php?error=dbError");
            }
        } else {
            header("location: ../view/ServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ServicioView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['servicioid'])) {

        $id = $_POST['servicioid'];

        $servicioBusiness = new ServicioBusiness();
        $result = $servicioBusiness->deleteTBServicio($id);

        if ($result == 1) {
            header("location: ../view/ServicioView.php?success=deleted");
        } else {
            header("location: ../view/ServicioView.php?error=dbError");
        }
    } else {
        header("location: ../view/ServicioView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['servicionombre']) && isset($_POST['serviciodescripcion']) && isset($_POST['tarifas']) && isset($_POST['servicioDuracion'])) {
        //recibir valores y guardar en variables 
        $nombre = $_POST['servicionombre'];
        $descripcion = $_POST['serviciodescripcion'];
        $tarifaId = $_POST['tarifas']['tarifaId'];
        $duracion = $_POST['servicioDuracion'];
        
         //echo ('<pre>');
         //var_dump($duracion);
        //echo ('</pre>');
        //exit;
        //validando datos
        if (strlen($nombre) > 0 && strlen($descripcion) > 0 ) {
            //creando objeto
             $servicio = new Servicio(0, $nombre, $descripcion, 1 , $tarifaId, $duracion);
        
                $servicioBusiness = new ServicioBusiness();

                $result =  $servicioBusiness->insertTBServicio($servicio );

                if ($result == 1) {
                    header("location: ../view/ServicioView.php?success=inserted");
                } else {
                    header("location: ../view/ServicioView.php?error=dbError");
                }
        } else {
            header("location: ../view/ServicioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ServicioView.php?error=error");
    }
}




<?php


include 'CitaBusiness.php';



if (isset($_POST['update'])) {

    if (isset($_POST['barberoId']) && isset($_POST['clienteId']) && isset($_POST['fecha']) && isset($_POST['hora'])  && isset($_POST['servicioId'])) {
        $barberoId = $_POST['barberoId'];
        $clienteId = $_POST['clienteId'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['hora'];
        $activo = 1;
        $servicioId = $_POST['servicioId'];
        


        if ( strlen($barberoId) > 0 && strlen($clienteId) > 0 && strlen($fecha) > 0 && strlen($hora) > 0  && strlen($servicioId) > 0) {

            $cita = new  Cita(0,$barberoId,$clienteId,$fecha,$hora,$activo,$servicioId);
            $citaBusiness = new CitaBusiness();


            $result = $citaBusiness->updateTBCita($cita);


            if ($result == 1) {
                header("location: ../view/CitaView.php?success=updated");
            } else {
                header("location: ../view/CitaView.php?error=dbError");
            }
        } else {
            header("location: ../view/CitaView.php?error=emptyField");
        }
    }
} else if (isset($_POST['delete'])) {

    if (isset($_POST['citaId'])) {

        $id = $_POST['citaId'];

        $citaBusiness = new CitaBusiness();
        $result = $citaBusiness->deleteTBCita($id);

        if ($result == 1) {
            header("location: ../view/CitaView.php?success=deleted");
        } else {
            header("location: ../view/CitaView.php?error=dbError");
        }
    } else {
        header("location: ../view/CitaView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar
    
    if (isset($_POST['barberos']['idbarbero']) && isset($_POST['clientes']['idcliente']) && isset($_POST['citafecha']) && isset($_POST['horas']['valorHora'])  && isset($_POST['servicios']['idservicio'])) {
        //recibir valores y guardar en variables
        $barberoId = $_POST['barberos']['idbarbero'];
        $clienteId = $_POST['clientes']['idcliente'];
        $fecha = $_POST['citafecha'];
        $hora = $_POST['horas']['valorHora'];
        $activo = 1;
        $servicioId = $_POST['servicios']['idservicio'];
        //validando datos
        
        if ( strlen($barberoId) > 0 && strlen($clienteId) > 0 && strlen($fecha) > 0 && strlen($servicioId) > 0 && strlen($hora) > 0) {
            //creando objeto
            
            $cita = new Cita (0,$barberoId,$clienteId,$fecha,$hora,$activo,$servicioId);
            $citaBusiness = new CitaBusiness();
            $result = $citaBusiness->insertTBCita($cita);
            
            if ($result == 1) {
                header("location: ../view/CitaView.php?success=inserted");
            } else {
                header("location: ../view/CitaView.php?error=dbError");
            }
        } else {
            header("location: ../view/CitaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/CitaView.php?error=error");
    }
}

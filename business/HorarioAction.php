<?php

include './HorarioBusiness.php';
include './CitaBusiness.php';
include './LogicBusiness/Funciones.php';



if (isset($_POST['update'])) {

    if (isset($_POST['horarioId']) && isset($_POST['fecha'])) {
        $id = $_POST['horarioId'];
        $barbero = $_POST['barberoId'];
        $fecha = $_POST['fecha'];
        $fechaInicial = $_POST['horaInicial'];
        $fechaFinal = $_POST['horaFinal'];
        $activo = isset($_POST['activo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
        $citaBusiness = new CitaBusiness();
        $funciones = new Funciones();
        $citas = $citaBusiness->getTBCitaByIdBarbero($barbero);


        if (strlen($fecha) > 0 && strlen($barbero) > 0) {
 
            $horario = new Horario($id, $barbero, $fecha, $fechaInicial, $fechaFinal,1);
            
            $horarioBusiness = new HorarioBusiness();

            foreach ($citas as $currentCita) {
                if ( $funciones->diaSemana($currentCita->getFecha()) == $fecha) {
                   $result = -1;
                }
            }

          

            if ($result != -1) {
                $result = $horarioBusiness->updateTBHorario($horario);
            }
            if ($result == 1) {
                header("location: ../view/HorarioView.php?success=updated");
            } else if($result == -1){
                header("location: ../view/HorarioView.php?error=error");
            }
        } else {
            header("location: ../view/HorarioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/HorarioView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['horarioId'])) {

        $id = $_POST['horarioId'];
        $barbero = $_POST['barberoId'];
        $fecha = $_POST['fecha'];
        $citaBusiness = new CitaBusiness();
        $funciones = new Funciones();
        $citas = $citaBusiness->getTBCitaByIdBarbero($barbero);
        $horarioBusiness = new HorarioBusiness();
        foreach ($citas as $currentCita) {
            if ( $funciones->diaSemana($currentCita->getFecha()) == $fecha) {
               $result = -1;
            }
        }
        if ($result != -1) {
            $result = $horarioBusiness->deleteTBHorario($id);
        }

        if ($result == 1) {
            header("location: ../view/HorarioView.php?success=deleted");
        } else if ($result == -1) {
            header("location: ../view/HorarioView.php?error=error");
        }
    } else {
        header("location: ../view/HorarioView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

   
    if (isset($_POST['barberos']) && isset($_POST['fecha'])) {
        //recibir valores y guardar en variables 
        $barbero = $_POST['barberos']['barberoId'];
        $fecha = $_POST['fecha'];
        $fechaInicial = $_POST['horaInicial'];
        $fechaFinal = $_POST['horaFinal'];
        $activo =1;
        
        //validando datos
        if (strlen($barbero) > 0 && strlen($fecha) > 0) {
            //creando objeto
            $horario = new Horario(0, $barbero, $fecha, $fechaInicial, $fechaFinal, $activo);
            
            $horarioBusiness = new HorarioBusiness();
            
            $result =  $horarioBusiness->insertTBHorario($horario);
            
            if ($result == 1) {
                header("location: ../view/HorarioView.php?success=inserted");
            } else {
                header("location: ../view/HorarioView.php?error=dbError");
            }
        } else {
            header("location: ../view/HorarioView.php?error=emptyField");
        }
    } else {
        header("location: ../view/HorarioView.php?error=error");
    }
}
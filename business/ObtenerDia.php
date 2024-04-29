<?php

include '../business/LogicBusiness/Funciones.php';
include '../business/CitaBusiness.php';
include '../business/HorarioBusiness.php';
include '../business/ServicioBusiness.php';

    $citaBusiness = new CitaBusiness();
    $servicioBusiness = new ServicioBusiness();
    $horarioBusiness = new HorarioBusiness();
    $funciones = new Funciones();
    //obtengo los datos desde el ajax   
    $dia = $_POST['dato'] ?? null;
    $numeroDia = $funciones->diaSemana($dia);
    $barberoId = $_POST['dato2'] ?? null;
    $fecha = $_POST['dato3'] ?? null;
    $servicioId = $_POST['dato4'] ?? null;
    $servicioDuracion = $servicioBusiness->getTBServicioById($servicioId)->getDuracion();
    $citasBarbero = $citaBusiness->getTBCitaByBarberoId($barberoId, $fecha);
    $horarioBarbero = $horarioBusiness->getTBHorarioByDay($numeroDia, $barberoId);
    $horaInicio = $horarioBarbero->getFechaInicial();
    $horaFin = $horarioBarbero->getFechaFinal();
    $horasOcupadas = array();
    foreach ($citasBarbero as $cita) {
       $hora = $cita->getHora();
        array_push($horasOcupadas, $hora);
    }
    


    $horasDeTrabajo = $funciones->horarioHoras($horaInicio, $horaFin);
    $horasDisponibles = $funciones->horasDisponibles($horasDeTrabajo, $horasOcupadas, $servicioDuracion);

    $contador = 1;
    $respuestaHtml = "<table>";
    $respuestaHtml .= "
        <td>
        <tr>
        <select name='horas[valorHora]'>
        <option selected value=''> -- Elija una hora -- </option>";
    foreach ($horasDisponibles as $hora) {
        
        $respuestaHtml .= "
         <option value='".$hora."'>".$hora."</option>
        
        ";
    }
    $respuestaHtml .= "</select>
    </td>
    </tr></table>";
    echo $respuestaHtml;

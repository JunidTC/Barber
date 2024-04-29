<?php


class Funciones{

    //constructor
    public function __construct() {
        
    }

    //funcion para calcular el monto total de la factura
    public function montoTotal($cantidadServicios, $tarifa){
        $montoTotal = $tarifa * $cantidadServicios;
        return $montoTotal;
    }

    //funcion para calcular el monto total de la factura con impuesto
    public function montoTotalConImpuesto( $monto, $impuesto){

        if($impuesto < 10){
            $impuesto ='0.0'.$impuesto;
        }else{
            $impuesto ='0.'.$impuesto;
        }
        $montoTotalImpuesto = $monto + ($monto * $impuesto);
        return $montoTotalImpuesto;
    }

    //funcion para obtener la fecha actual
    public function fechaActual(){
        $fechaActual = date("Y-m-d");
        return $fechaActual;
    }

    //funcion que recibe dos horas y me devuelve una lista con las horas intermedias cada 30 minutos

    public function horarioMinutos($horaInicio, $horaFin){
        $horaInicio = strtotime($horaInicio);
        $horaFin = strtotime($horaFin);
        $horas = array();
        while($horaInicio <= $horaFin){
            $horas[] = date('H:i:s', $horaInicio);
            $horaInicio += 1800;
        }
        return $horas;
    }

    public function horarioHoras($horaInicio, $horaFin){
        $horaInicio = strtotime($horaInicio);
        $horaFin = strtotime($horaFin);
        $horas = array();
        while($horaInicio <= $horaFin){
            $horas[] = date('H:i:s', $horaInicio);
            $horaInicio += 3600;
        }
        return $horas;
    }

    //funcion que recibe una fecha y me devuelve el dia de la semana

    public function diaSemana($fecha){
        $dia = date('w', strtotime($fecha));
        return $dia;
    }
    public function horasDisponibles($horasDisponibles, $horasOcupadas, $duracionServicio){
    
        $horas = array_diff($horasDisponibles, $horasOcupadas);
        return $horas;
    
    }

}

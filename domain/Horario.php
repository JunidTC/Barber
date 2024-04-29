<?php
class Horario
{
    private $horarioId;
    private $barberoId;
    private $fecha;
    private $fechaInicial;
    private $fechaFinal;
    private $activo;

    function __construct($horarioId,$barberoId,$fecha,$fechaInicial,$fechaFinal,$activo){
        $this->horarioId = $horarioId;
        $this->barberoId = $barberoId;
        $this->fecha = $fecha;
        $this->fechaInicial = $fechaInicial;
        $this->fechaFinal = $fechaFinal;
        $this->activo = $activo;
    }

    //sets y gets
    public function getHorarioId()
    {
        return $this->horarioId;
    }

    public function setHorarioId($horarioId)
    {
        $this->horarioId = $horarioId;
    }

    public function getBarberoId()
    {
        return $this->barberoId;
    }

    public function setBarberoId($barberoId)
    {
        $this->barberoId = $barberoId;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getFechaInicial()
    {
        return $this->fechaInicial;
    }

    public function setFechaInicial($fechaInicial)
    {
        $this->fechaInicial = $fechaInicial;
    }

    public function getFechaFinal()
    {
        return $this->fechaFinal;
    }

    public function setFechaFinal($fechaFinal)
    {
        $this->fechaFinal = $fechaFinal;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }
}
<?php
class ClienteTipo
{
    private $clienteTipoId;
    private $periodicidad;
    private $cancelacion;
    private $ingreso;
    private $puntaje;
    private $activo;

    function __construct($clienteTipoId,$periodicidad, $cancelacion,$ingreso,$puntaje, $activo ){
        $this->clienteTipoId = $clienteTipoId;
        $this->periodicidad = $periodicidad;
        $this->cancelacion = $cancelacion;
        $this->ingreso = $ingreso;
        $this->puntaje = $puntaje;
        $this->activo = $activo;
    }

    //sets y gets

    function getClienteTipoId()
    {
        return $this->clienteTipoId;
    }
    function setId($clienteTipoId)
    {
        $this->clienteTipoId = $clienteTipoId;
    }
    function getPeriodicidad()
    {
        return $this->periodicidad;
    }
    function setPeriodicidad($periodicidad)
    {
        $this->periodicidad = $periodicidad;
    }
    function getCancelacion()
    {
        return $this->cancelacion;
    }
    function setCancelacion($cancelacion)
    {
        $this->cancelacion = $cancelacion;
    }
    function getIngreso()
    {
        return $this->ingreso;
    }

    function setIngreso($ingreso)
    {
        $this->ingreso = $ingreso;
    }

    function getPuntaje()
    {
        return $this->puntaje;
    }

    function setPuntaje($puntaje)
    {
        $this->puntaje = $puntaje;
    }

    function getActivo()
    {
        return $this->activo;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }
}
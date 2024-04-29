<?php
class Cita
{
    private $citaId;
    private $barberoId;
    private $clienteId;
    private $fecha;
    private $hora;
    private $activo;
    private $servicioId;
    

    function __construct($citaId,$barberoId,$clienteId,$fecha, $hora ,$activo ,$servicioId){
        $this->citaId = $citaId;
        $this->barberoId = $barberoId;
        $this->clienteId = $clienteId;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->activo = $activo;
        $this->servicioId = $servicioId;
        

    }

    //sets y gets
    public function getCitaId()
    {
        return $this->citaId;
    }

    public function setCitaId($citaId)
    {
        $this->citaId = $citaId;
    }

    public function getBarberoId()
    {
        return $this->barberoId;
    }

    public function setBarberoId($barberoId)
    {
        $this->barberoId = $barberoId;
    }

    public function getClienteId()
    {
        return $this->clienteId;
    }

    public function setClienteId($clienteId)
    {
        $this->clienteId = $clienteId;
    }

    public function getFecha()
    {
        return $this->fecha;
    }

    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    public function getHora()
    {
        return $this->hora;
    }

    public function setHora($hora)
    {
        $this->hora = $hora;
    }


    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }

    public function getServicioId()
    {
        return $this->servicioId;
    }

    public function setServicioId($servicioId)
    {
        $this->servicioId = $servicioId;
    }




}
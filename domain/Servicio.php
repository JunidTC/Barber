<?php

class Servicio
{
    private $idServicio;
    private $nombre;
    private $descripcion;
    private $activo;
    private $tarifaId;
    private $duracion;

    //contructor de la clase
    public function __construct($idServicio,$nombre,$descripcion,$activo, $tarifaId, $duracion)
    {
        $this->idServicio = $idServicio;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
        $this->tarifaId = $tarifaId;
        $this->duracion = $duracion;
    }

    //getters y setters
    public function getIdServicio()
    {
        return $this->idServicio;
    }

    public function setIdServicio($idServicio)
    {
        $this->idServicio = $idServicio;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getActivo()
    {
        return $this->activo;
    }

    public function setActivo($activo)
    {
        $this->activo = $activo;
    }   

    public function getTarifaId()
    {
        return $this->tarifaId;
    }

    public function setTarifaId($tarifaId)
    {
        $this->tarifaId = $tarifaId;
    }

    public function getDuracion()
    {
        return $this->duracion;
    }

    public function setDuracion($duracion)
    {
        $this->duracion = $duracion;
    }

}

<?php

class ClienteCategoria
{
    private $clienteCategoriaId;
    private $descripcion;
    private $activo;
    private $nombreCategoria;
    private $clienteTipoId;

    function __construct($clienteCategoriaId,$descripcion, $activo,$nombreCategoria, $clienteTipoId){
        $this->clienteCategoriaId = $clienteCategoriaId;
        $this->descripcion = $descripcion;
        $this->activo = $activo;
        $this->nombreCategoria = $nombreCategoria;
        $this->clienteTipoId = $clienteTipoId;
    }


    function getId()
    {
        return $this->clienteCategoriaId;
    }

    function setId($clienteCategoriaId)
    {
        $this->clienteCategoriaId = $clienteCategoriaId;
    }

    function getDescripcion()
    {
        return $this->descripcion;
    }

    function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    function getActivo()
    {
        return $this->activo;
    }

    function setActivo($activo)
    {
        $this->activo = $activo;
    }

    function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }

    function setNombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;
    }

    function getClienteTipoId()
    {
        return $this->clienteTipoId;
    }

    function setClienteTipoId($clienteTipoId)
    {
        $this->clienteTipoId = $clienteTipoId;
    }

}



   
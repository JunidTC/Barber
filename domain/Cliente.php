<?php
class Cliente
{
    private $idcliente;
    private $nombre;
    private $apellido;
    private $correo;
    private $numeroTelefono;
    private $activo;
    private $clienteCategoriaId;

    function __construct($idcliente,$nombre, $apellido,$numeroTelefono,$correo, $activo, $clienteCategoriaId ){
        $this->idcliente = $idcliente;
        $this->nombre = $nombre;
        $this->apellido = $apellido;
        $this->numeroTelefono = $numeroTelefono;
        $this->correo = $correo;
        $this->activo = $activo;
        $this->clienteCategoriaId = $clienteCategoriaId;
    }

    //sets y gets

 //set y get de clienteCategoriaId

    public function getClienteCategoriaId()
    {
        return $this->clienteCategoriaId;
    }

    public function setClienteCategoriaId($clienteCategoriaId)
    {
        $this->clienteCategoriaId = $clienteCategoriaId;
    }

    function getId()
    {
        return $this->idcliente;
    }
    function setId($idcliente)
    {
        $this->idcliente = $idcliente;
    }
    function getNombre()
    {
        return $this->nombre;
    }
    function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function getApellido()
    {
        return $this->apellido;
    }
    function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }
    function getNumeroTelefono()
    {
        return $this->numeroTelefono;
    }

    function setNumeroTelefono($numeroTelefono)
    {
        $this->numeroTelefono = $numeroTelefono;
    }

    function getCorreo()
    {
        return $this->correo;
    }

    function setCorreo($correo)
    {
        $this->correo = $correo;
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

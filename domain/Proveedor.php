<?php

class Proveedor {

    private $provedorId;
    private $nombre;
    private $lineaProducto;
    private $telefono;
    private $email;
    private $direccion;
    private $activo;


    //contructor 

    public function __construct($provedorId, $nombre, $lineaProducto, $telefono, $email, $direccion, $activo) {
        $this->provedorId = $provedorId;
        $this->nombre = $nombre;
        $this->lineaProducto = $lineaProducto;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->direccion = $direccion;
        $this->activo = $activo;
    }

    //getters and setters alls 
    
    public function getProveedorId() {
        return $this->provedorId;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getLineaProducto() {
        return $this->lineaProducto;
    }


    public function getTelefono() {
        return $this->telefono;
    }


    public function getEmail() {
        return $this->email;
    }
 
    public function getDireccion() {
        return $this->direccion;
    }

    public function getActivo() {
        return $this->activo;
    }

    public function setProveedorId($provedorId) {
        $this->provedorId = $provedorId;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    public function setLineaProducto($lineaProducto) {
        $this->lineaProducto = $lineaProducto;
    }

    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setActivo($activo) {
        $this->activo = $activo;
    }

    



}

?>
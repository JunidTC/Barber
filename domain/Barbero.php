<?php

class Barbero {

    private $barberoId;
    private $nombre;
    private $telefono;
    private $email;
    private $activo;


    //contructor 


    public function __construct($barberoId, $nombre, $telefono, $email,  $activo) {

        $this->barberoId = $barberoId;
        $this->nombre = $nombre;
        $this->telefono = $telefono;
        $this->email = $email;
        $this->activo = $activo;
    }

    //getters and setters alls 
    
    public function getBarberoId() {
        return $this->barberoId;
    }

    public function getNombre() {
        return $this->nombre;
    }

    


    public function getTelefono() {
        return $this->telefono;
    }


    public function getEmail() {
        return $this->email;
    }
 

    public function getActivo() {
        return $this->activo;
    }

    public function setBarberoId($barberoId) {
        $this->barberoId = $barberoId;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }


    public function setTelefono($telefono) {
        $this->telefono = $telefono;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

   
    public function setActivo($activo) {
        $this->activo = $activo;
    }


}

?>
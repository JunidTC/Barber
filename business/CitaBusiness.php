<?php

include '../data/CitaData.php';

class CitaBusiness {

    private $citaData;

    public function __construct() {
        $this->citaData = new CitaData();
    }

    public function insertTBCita($cita) {
        return $this->citaData->insertTBCita($cita);
    }

    public function updateTBCita($cita) {
        return $this->citaData->updateTBCita($cita);
    }

    public function deleteTBCita($citaId) {
        return $this->citaData->deleteTBCita($citaId);
    }

    public function getAllTBCitas() {
        
        return $this->citaData->getAllTBCitas();
       
    }

    public function getTBCitaById($citaId) {
        return $this->citaData->getTBCitaById($citaId);
    }

    public function getTBCitaByBarberoId($barberoId, $fecha) {
        return $this->citaData->getTBCitaByBarberoFecha($barberoId, $fecha);
    }

    
    public function getAllTBCitasAgrupadas() {
        
        return $this->citaData->getAllTBCitasAgrupadas();
       
    }
    public function getTBCitaByIdBarbero($barberoId) {
        
        return $this->citaData->getTBCitaByBarberoId($barberoId);
       
    }

    
}
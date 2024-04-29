<?php

include '../data/HorarioData.php';

class HorarioBusiness {

    private $horarioData;

    public function __construct() {
        $this->horarioData = new HorarioData();
    }

    public function insertTBHorario($horario) {
        return $this->horarioData->insertTBHorario($horario);
    }

    public function updateTBHorario($horario) {
        return $this->horarioData->updateTBHorario($horario);
    }

    public function deleteTBHorario($horarioId) {
        return $this->horarioData->deleteTBHorario($horarioId);
    }

    public function getAllTBHorarios() {
        return $this->horarioData->getAllTBHorarios();
       
    }

    public function getTBHorarioById($horarioId) {
        return $this->horarioData->getTBHorarioById($horarioId);
    }
 
    public function getTBHorarioByDay($dia, $idBarbero) {
        return $this->horarioData->getTBHorarioByDay($dia, $idBarbero);
    }
    
}
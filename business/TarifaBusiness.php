<?php

include '../data/TarifaData.php';

class TarifaBusiness {

    private $tarifaData;

    public function __construct(){
        $this->tarifaData = new TarifaData();
    }

    public function insertTBTarifa($tarifa) {
        return $this->tarifaData->insertTBTarifa($tarifa);
    }

    public function updateTBTarifa($tarifa) {
        return $this->tarifaData->updateTBTarifa($tarifa);
    }

    public function deleteTBTarifa($idtarifa) {
        return $this->tarifaData->deleteTBTarifa($idtarifa);
    }

    public function getAllTBTarifas() {
        return $this->tarifaData->getAllTBTarifas();
    }

    public function getAllTBTarifaDesactivada() {
        return $this->tarifaData->getAllTBTarifaDesactivada();
    }
    
    public function getTBTarifaById($idtarifa) {
        return $this->tarifaData->getTBTarifaById($idtarifa);
    }
}

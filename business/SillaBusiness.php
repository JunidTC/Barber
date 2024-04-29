<?php

include '../data/SillaData.php';

class SillaBusiness {

    private $sillaData;

    public function __construct() {
        $this->sillaData = new SillaData();
    }

    public function insertTBSilla($silla) {
        return $this->sillaData->insertTBSilla($silla);
    }

    public function updateTBSilla($silla) {
        return $this->sillaData->updateTBSilla($silla);
    }

    public function deleteTBSilla($idsilla) {
        return $this->sillaData->deleteTBSilla($idsilla);
    }

    public function getAllTBSillas() {
        return $this->sillaData->getAllTBSillas();
    }

    public function getAllTBSillasDesactivados() {
        return $this->sillaData->getAllTBSillasDesactivados();
    }
    
}

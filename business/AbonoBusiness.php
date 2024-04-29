<?php

include '../data/AbonoData.php';

class AbonoBusiness {

    private $abonoData;

    public function __construct() {
        $this->abonoData = new AbonoData();
    }

    public function insertTBAbono($abono) {
        return $this->abonoData->insertTBAbono($abono);
    }

    public function updateTBAbono($abono) {
        return $this->abonoData->updateTBAbono($abono);
    }

    public function deleteTBAbono($abonoId) {
        return $this->abonoData->deleteTBAbono($abonoId);
    }

    public function getAllTBAbonos() {
        
        return $this->abonoData->getAllTBAbonos();
       
    }


    public function getTBAbonoById($abonoId) {
        return $this->abonoData->getTBAbonoById($abonoId);
    }
 
    
}
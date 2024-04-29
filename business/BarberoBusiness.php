<?php
include '../data/BarberoData.php';

class BarberoBusiness{
    
    private $barberoData;
    
    public function __construct(){
        return $this->barberoData = new BarberoData();
    }
    
    public function insertTBBarbero($barbero){
        return $this->barberoData->insertTBBarbero($barbero);
    }
    
    public function updateTBBarbero($barbero){
        return $this->barberoData->updateTBBarbero($barbero);
    }
    
    public function deleteTBBarbero($barberoId){
        return $this->barberoData->deleteTBBarbero($barberoId);
    }
    
    public function getAllTBBarbero(){
        return $this->barberoData->getAllTBBarbero();
    }
    
    public function getTBBarberoById($barberoId){
        return $this->barberoData->getTBBarberoById($barberoId);
    }
    
    public function getAllTBBarberoDesactivado(){
        return $this->barberoData->getAllTBBarberoDesactivado();
    }
    

}

?>
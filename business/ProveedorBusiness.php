<?php
include '../data/ProveedorData.php';

class ProveedorBusiness
{

    private $provedorData;

    public function __construct()
    {
        return $this->provedorData = new ProveedorData();
    }

    public function insertTBProveedor($provedor)
    {
        return $this->provedorData->insertTBProveedor($provedor);
    }

    public function updateTBProveedor($provedor)
    {
        return $this->provedorData->updateTBProveedor($provedor);
    }

    public function deleteTBProveedor($provedorId)
    {
        return $this->provedorData->deleteTBProveedor($provedorId);
    }

    public function getAllTBProveedor()
    {
        return $this->provedorData->getAllTBProveedor();
    }

    public function getTBProveedorById($provedorId)
    {
        return $this->provedorData->getTBProveedorById($provedorId);
    }

    public function getAllTBProveedorDesactivado() {
        
        return $this->provedorData->getAllTBProveedorDesactivado();
       
    }


    
}

?>
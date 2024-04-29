<?php

include '../data/ClienteCategoriaData.php';

class ClienteCategoriaBusiness {

    private $clienteCategoriaData;

    public function __construct() {
        $this->clienteCategoriaData = new ClienteCategoriaData();
    }

    public function insertTBClienteCategoria($clienteCategoria) {
        return $this->clienteCategoriaData->insertTBClienteCategoria($clienteCategoria);
    }

    public function updateTBClienteCategoria($clienteCategoria) {
        return $this->clienteCategoriaData->updateTBClienteCategoria($clienteCategoria);
    }

    public function deleteTBClienteCategoria($clientecategoriaid) {
        return $this->clienteCategoriaData->deleteTBClienteCategoria($clientecategoriaid);
    }

    public function getAllTBClienteCategoria() {
        return $this->clienteCategoriaData->getAllTBClientesCategoria();
    }

    public function getAllTBClienteCategoriaDesactivado() {
        return $this->clienteCategoriaData->getAllTBClienteCategoriaDesactivado();
    }
    
    public function getTBClienteCategoriaById($clientecategoriaid) {
        return $this->clienteCategoriaData->getTBClienteCategoriaById($clientecategoriaid);
    }

    

   
}


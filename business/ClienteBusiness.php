<?php

include '../data/ClienteData.php';

class ClienteBusiness {

    private $clienteData;

    public function __construct() {
        $this->clienteData = new ClienteData();
    }

    public function insertTBCliente($cliente) {
        return $this->clienteData->insertTBCliente($cliente);
    }

    public function updateTBCliente($cliente) {
        return $this->clienteData->updateTBCliente($cliente);
    }

    public function deleteTBCliente($idcliente) {
        return $this->clienteData->deleteTBCliente($idcliente);
    }

    public function getAllTBCliente() {
        
        return $this->clienteData->getAllTBClientes();
       
    }

    public function getAllTBClienteDesactivado() {
        
        return $this->clienteData->getAllTBClienteDesactivado();
       
    }


    public function getTBClienteById($idcliente) {
        return $this->clienteData->getTBClienteById($idcliente);
    }
 
    
}

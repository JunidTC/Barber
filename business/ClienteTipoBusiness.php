<?php

include '../data/ClienteTipoData.php';

class ClienteTipoBusiness {

    private $clienteTipoData;

    public function __construct() {
        $this->clienteTipoData = new ClienteTipoData();
    }

    public function insertTBClienteTipo($clienteTipo) {
        return $this->clienteTipoData->insertTBClienteTipo($clienteTipo);
    }

    public function updateTBClienteTipo($clienteTipo) {
        return $this->clienteTipoData->updateTBClienteTipo($clienteTipo);
    }

    public function deleteTBClienteTipo($idclientetipo) {
        return $this->clienteTipoData->deleteTBClienteTipo($idclientetipo);
    }

    public function getAllTBClienteTipo() {
        return $this->clienteTipoData->getAllTBClientesTipo();
    }

    public function getAllTBClienteTipoDesactivado() {
        return $this->clienteTipoData->getAllTBClienteTipoDesactivado();
    }
    public function getTBTipoClienteById($idClienteTipo) {
        return $this->clienteTipoData->getTBTipoClienteById($idClienteTipo);
    }

}
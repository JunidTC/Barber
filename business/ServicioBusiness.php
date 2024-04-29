<?php

include '../data/ServicioData.php';

class ServicioBusiness {

    private $servicioData;

    public function __construct() {
        $this->servicioData = new ServicioData();
    }

    public function insertTBServicio($servicio) {
        return $this->servicioData->insertTBServicio($servicio);
    }

    public function updateTBServicio($servicio) {
        return $this->servicioData->updateTBServicio($servicio);
    }

    public function deleteTBServicio($idservicio) {
        return $this->servicioData->deleteTBServicio($idservicio);
    }

    public function getAllTBServicios() {
        return $this->servicioData->getAllTBServicios();
    }

    public function getAllTBServicioDesactivado() {
        return $this->servicioData->getAllTBServicioDesactivado();
    }

    public function getTBServicioById($idservicio) {
        return $this->servicioData->getTBServicioById($idservicio);
    }
    
}

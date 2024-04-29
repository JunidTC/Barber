<?php

include '../data/FacturaData.php';


class FacturaBusiness {

    private $facturaData;

    public function __construct() {
        $this->facturaData = new FacturaData();
    }

    public function insertTBFactura($factura) {
        return $this->facturaData->insertTBFactura($factura);
    }

    public function updateTBFactura($factura) {
        return $this->facturaData->updateTBFactura($factura);
    }

    public function deleteTBFactura($idfactura) {
        return $this->facturaData->deleteTBFactura($idfactura);
    }

    public function getAllTBFactura() {
        return $this->facturaData->getAllTBFactura();
    }


    public function getLastFactura() {
        return $this->facturaData->getLastFactura();
    }

    public function getFacturaById($idfactura) {
        return $this->facturaData->getFacturaById($idfactura);
    }
   
}
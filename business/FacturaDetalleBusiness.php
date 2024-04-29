<?php

include '../data/FacturaDetalleData.php';

class FacturaDetalleBusiness
{

    private $facturaDetalleData;

    public function __construct()
    {
        $this->facturaDetalleData = new FacturaDetalleData();
    }

    public function insertTBDetalleFactura($facturaDetalle)
    {
        return $this->facturaDetalleData->insertTBDetalleFactura($facturaDetalle);
    }

    public function updateTBDetalleFactura($facturaDetalle)
    {
        return $this->facturaDetalleData->updateTBDetalleFactura($facturaDetalle);
    }

    public function deleteTBDetalleTFactura($idfacturaDetalle)
    {
        return $this->facturaDetalleData->deleteTBDetalleTFactura($idfacturaDetalle);
    }

    public function getAllTBDetalleFacturas()
    {
        return $this->facturaDetalleData->getAllTBDetalleFacturas();
    }

    public function getTBDetalleFacturaById($idfacturaDetalle)
    {
        return $this->facturaDetalleData->getTBDetalleFacturaById($idfacturaDetalle);
    }

    public function getTBDetalleFacturasByFacturaId($idfactura)
    {
        return $this->facturaDetalleData->getTBDetalleFacturaByFacturaId($idfactura);
    }
}

<?php

include '../data/ImpuestoVentaData.php';

class ImpuestoVentaBusiness
{

    private $impuestoVentaData;

    public function __construct()
    {
        $this->impuestoVentaData = new ImpuestoVentaData();
    }

    public function insertTBImpuestoVenta($impuestoventa)
    {
        return $this->impuestoVentaData->insertTBImpuestoVenta($impuestoventa);
    }

    public function updateTBImpuestoVenta($impuestoventa)
    {
        return $this->impuestoVentaData->updateTBImpuestoVenta($impuestoventa);
    }

    public function deleteTBImpuestoVenta($idimpuestoventa)
    {
        return $this->impuestoVentaData->deleteTBImpuestoVenta($idimpuestoventa);
    }

    public function getAllTBImpuestoVentas()
    {
        return $this->impuestoVentaData->getAllTBImpuestoVentas();
    }

    public function getAllTBImpuestoVentaDesactivado()
    {
        return $this->impuestoVentaData->getAllTBImpuestoVentaDesactivado();
    }

    public function getTBImpuestoVentaById($idimpuestoventa)
    {
        return $this->impuestoVentaData->getTBImpuestoVentaById($idimpuestoventa);
    }
}

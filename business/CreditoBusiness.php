<?php
require_once '../data/CreditoData.php';
class CreditoBusiness {

    private $creditoData;

    public  function __construct() {
        
        $this->creditoData = new CreditoData();
    }

    public function insertTBCredito($credito) {
        return $this->creditoData->insertTBCredito($credito);
    }

    public function updateTBCredito($credito) {
        return $this->creditoData->updateTBCredito($credito);
    }

    public function deleteTBCredito($creditoId) {
        return $this->creditoData->deleteTBCredito($creditoId);
    }

    public function getAllTBCreditos() {
        return $this->creditoData->getAllTBCreditos();
    }

    public function getTBCreditoById($creditoId) {
        return $this->creditoData->getTBCreditoById($creditoId);
    }
    public function foundTBCreditoByIdFactura($facturaId) {
        return $this->creditoData->foundTBCreditoByIdFactura($facturaId);
    }

    public function getTBCreditoByIdFactura($facturaId) {
        return $this->creditoData->getTBCreditoByIdFactura($facturaId);
    }
    public function deleteTBCreditoDelete($creditoId) {
        return $this->creditoData->deleteTBCreditoDelete($creditoId);
    }


}
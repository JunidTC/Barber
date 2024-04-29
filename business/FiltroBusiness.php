<?php 

include '../data/FiltroData.php';

class FiltroBusiness {

	private $FiltroData;

    public function __construct() {
        $this->FiltroData = new FiltroData();
    }

    public function getDatosFiltro($columna1, $columna2, $tabla,$dato){
        return $this->FiltroData->getDatosFiltro($columna1, $columna2, $tabla,$dato);
    }

}


 ?>
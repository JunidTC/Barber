<?php 


include_once 'Data.php';
include '../domain/ImpuestoVenta.php';

class ImpuestoVentaData extends Data{


	 public function insertTBImpuestoVenta($impuestoventa) {

        $arrayImpuestoVenta = $this->getAllTBImpuestoVentas();
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
       
        $queryGetLastId = "SELECT MAX(tbimpuestoventaid) AS impuestoventaid  FROM `tbimpuestoventa`";
        if (!empty($arrayImpuestoVenta)) {
            $idCont = mysqli_query($conn, $queryGetLastId);
            if ($row = mysqli_fetch_row($idCont)) {
                $nextId = trim($row[0]) + 1;
            }
        } else {
            $nextId = 1;
        }
        $queryInsert = "INSERT INTO `tbimpuestoventa` VALUES (" . $nextId . ",'" .
                $impuestoventa->getPorcentaje() . "','" .
                $impuestoventa->getFechaActualizacion() . "','" .
                $impuestoventa->getActivo() . "');";

        $result = mysqli_query($conn, $queryInsert);
        mysqli_close($conn);
        return $result;
    }

     public function updateTBImpuestoVenta($impuestoventa) {
        
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        $queryUpdate = "UPDATE `tbimpuestoventa` SET `tbimpuestoventaporcentaje`='" . trim( $impuestoventa->getPorcentaje(),'%')   .
                "', `tbimpuestoventafechaactualizacion`='" . $impuestoventa->getFechaactualizacion() .
                "', `tbimpuestoventaactivo`='" . $impuestoventa->getActivo() .
                "' WHERE `tbimpuestoventaid` =" .  trim( $impuestoventa->getIdimpuestoventa(),'₡')  . ";";
             
        $result = mysqli_query($conn, $queryUpdate);
        mysqli_close($conn);

        return $result;
    }

    public function deleteTBImpuestoVenta($idimpuestoventa) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $queryDelete = "UPDATE `tbimpuestoventa` SET `tbimpuestoventaactivo`= 0 WHERE `tbimpuestoventaid` = " . $idimpuestoventa . ";";
        $result = mysqli_query($conn, $queryDelete);
        mysqli_close($conn);

        return $result;
    }

	public function getAllTBImpuestoVentas() {
       
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventaactivo = 1";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $impuestoventas = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentImpuestoVenta= new ImpuestoVenta($row['tbimpuestoventaid'], $row['tbimpuestoventaporcentaje'], $row['tbimpuestoventafechaactualizacion'], $row['tbimpuestoventaactivo']);
            array_push($impuestoventas, $currentImpuestoVenta);
        }
        return $impuestoventas;
    }

    public function getAllTBImpuestoVentaDesactivado() {
       
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventaactivo = 0";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $impuestoventas = [];
        while ($row = mysqli_fetch_array($result)) {
            $currentImpuestoVenta= new ImpuestoVenta($row['tbimpuestoventaid'], $row['tbimpuestoventaporcentaje'], $row['tbimpuestoventafechaactualizacion'], $row['tbimpuestoventaactivo']);
            array_push($impuestoventas, $currentImpuestoVenta);
        }
        return $impuestoventas;
    }

    //Metodo para buscar un impuesto de venta por su id

    public function getTBImpuestoVentaById($idimpuestoventa) {
        $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');

        $querySelect = "SELECT * FROM tbimpuestoventa WHERE tbimpuestoventaid = " . $idimpuestoventa . ";";
        $result = mysqli_query($conn, $querySelect);
        mysqli_close($conn);
        $currentImpuestoVenta = null;
        while ($row = mysqli_fetch_array($result)) {
            $currentImpuestoVenta= new ImpuestoVenta($row['tbimpuestoventaid'], $row['tbimpuestoventaporcentaje'], $row['tbimpuestoventafechaactualizacion'], $row['tbimpuestoventaactivo']);
           
        }
        return $currentImpuestoVenta;
    }

   
}

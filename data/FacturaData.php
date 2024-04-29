<?php
include_once 'Data.php';
include '../domain/Factura.php';

class FacturaData extends Data
{

    public function getAllTBFactura()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbfactura WHERE tbfacturaactivo = 1;";
            $result = mysqli_query($conn, $querySelect);
            $facturas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currenteFactura = new Factura($row['tbfacturaid'], $row['tbclienteid'], $row['tbimpuestoventaid'], $row['tbfacturatotal'],  $row['tbfacturamonto'], $row['tbfacturafecha'], $row['tbfacturaactivo'], $row['tbmetodopagoid']);
                array_push($facturas, $currenteFactura);
            }
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }


        return $facturas;
    }



    public function insertTBFactura($factura)
    {
        // try - cath para manejar las excepciones
        try {
            
            $facturas = $this->getAllTBFactura();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbfacturaid) AS facturaid  FROM tbfactura";
            if (!empty($facturas)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbfactura` VALUES (" . $nextId . ",'" .
                $factura->getFecha() . "'," .
                $factura->getMonto() . "," .
                $factura->getImpuestoVenta() . "," .
                $factura->getMontoTotal() . "," .
                $factura->getClienteId() . "," .
                $factura->getActivo() .",".
                $factura->getMetodoPago() . ");";
                

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }


    public function updateTBFactura($factura)
    {
        
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

             $queryUpdate = "UPDATE tbfactura SET `tbfacturafecha`='" . $factura->getFecha() .
                "', `tbfacturamonto`=" . trim($factura->getMonto(), '₡') .
                ", `tbimpuestoventaid`=" . $factura->getImpuestoVenta() .
                ", `tbfacturatotal`=" .  trim($factura->getMontoTotal(), '₡') .
                ", `tbclienteid`=" . $factura->getClienteId() .
                ", `tbfacturaactivo`=" . $factura->getActivo() .
                ", `tbmetodopagoid`=" . $factura->getMetodoPago() .
                " WHERE `tbfacturaid` = " . $factura->getFacturaId() . ";";
        

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBFactura($id)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryDelete = "DELETE FROM tbfactura  WHERE `tbfacturaid` = " . $id . ";";

            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    // obtener solo los descativados
    public function getAllTBFacturaInactivos()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfactura WHERE tbfacturaactivo = 0;";

            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }


    // obtener la ultima factura

    public function getLastFactura()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfactura ORDER BY tbfacturaid DESC LIMIT 1;";

            $result = mysqli_query($conn, $querySelect);
            $currenteFactura = null;
            while ($row = mysqli_fetch_array($result)) {
                $currenteFactura = new Factura($row['tbfacturaid'], $row['tbclienteid'], $row['tbimpuestoventaid'], $row['tbfacturatotal'],  $row['tbfacturamonto'], $row['tbfacturafecha'], $row['tbfacturaactivo'], $row['tbmetodopagoid']);
               
            }
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $currenteFactura;
    }

    // traer la factura por id
    public function getFacturaById($id)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfactura WHERE tbfacturaid = " . $id . ";";
            $result = mysqli_query($conn, $querySelect);
            $currenteFactura = null;
            while ($row = mysqli_fetch_array($result)) {
                $currenteFactura = new Factura($row['tbfacturaid'], $row['tbclienteid'], $row['tbimpuestoventaid'], $row['tbfacturatotal'],  $row['tbfacturamonto'], $row['tbfacturafecha'], $row['tbfacturaactivo'], $row['tbmetodopagoid']);
               
            }
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $currenteFactura;
    }


}

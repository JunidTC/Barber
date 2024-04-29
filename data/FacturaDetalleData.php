<?php


include_once 'Data.php';
include '../domain/DetalleFactura.php';

class FacturaDetalleData extends Data
{


    public function insertTBDetalleFactura($detalleFactura)
    {

        // try - cath para manejar las excepciones
        try {
            $arrayDetalleFactura = $this->getAllTBDetalleFacturas();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryGetLastId = "SELECT MAX(tbfacturadetalleid) AS iddetalle  FROM `tbfacturadetalle`";
            if (!empty($arrayDetalleFactura)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbfacturadetalle` VALUES (" . $nextId . "," .
                $detalleFactura->getFacturaId() . "," .
                $detalleFactura->getServicioId() . "," .
                $detalleFactura->getCantidadServicio() . "," .
                $detalleFactura->getActivo() . ");";
                

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBDetalleFactura($detalleFactura)
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE `tbfacturadetalle` SET `tbfacturaid`=" . $detalleFactura->getFacturaId() .
                ", `tbservicioid`=" . $detalleFactura->getServicioId() . ", `tbfacturadetallecantidadservicio`=" . $detalleFactura->getCantidadServicio() .
                " WHERE `tbfacturadetalleid` =" .  $detalleFactura->getIdDetalleFactura() . ";";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBDetalleTFactura($detalleFactura)
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "DELETE FROM tbfacturadetalle WHERE `tbfacturadetalleid` = " . $detalleFactura . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function getAllTBDetalleFacturas()
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfacturadetalle WHERE tbfacturadetalleactivo = 1 GROUP BY tbfacturaid;";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $detalleFactura = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentDetalleFactura = new DetalleFactura($row['tbfacturaid'], $row['tbservicioid'], $row['tbfacturadetallecantidadservicio'], $row['tbfacturadetalleid'], $row['tbfacturadetalleactivo']);
                array_push($detalleFactura, $currentDetalleFactura);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $detalleFactura;
    }


    //Metodo para buscar un detalle de factura por id

    public function getTBDetalleFacturaById($id)
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfacturadetalle WHERE tbfacturadetalleactivo = 1 AND tbfacturadetalleid = " . $id;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $detalleFactura = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentDetalleFactura = new DetalleFactura($row['tbfacturaid'], $row['tbservicioid'], $row['tbfacturadetallecantidadservicio'], $row['tbfacturadetalleid'], $row['tbfacturadetalleactivo']);
                array_push($detalleFactura, $currentDetalleFactura);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $detalleFactura;
    }


    // metodo para traer una lista de detalles por id de factura

    public function getTBDetalleFacturaByFacturaId($id)
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbfacturadetalle WHERE tbfacturadetalleactivo = 1 AND tbfacturaid = " . $id;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $detalleFactura = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentDetalleFactura = new DetalleFactura($row['tbfacturaid'], $row['tbservicioid'], $row['tbfacturadetallecantidadservicio'], $row['tbfacturadetalleid'], $row['tbfacturadetalleactivo']);
                array_push($detalleFactura, $currentDetalleFactura);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $detalleFactura;
    }


}

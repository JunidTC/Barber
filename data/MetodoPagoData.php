<?php


include_once 'Data.php';
include '../domain/MetodoPago.php';

class MetodoPagoData extends Data
{


    public function insertTBMetodoPago($metodopago)
    {

        try {
            $arrayMetodoPago = $this->getAllTBMetodoPagos();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbmetodopagoid) AS metodopagoid  FROM tbmetodopago";
            if (!empty($arrayMetodoPago)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }

            $queryInsert = "INSERT INTO `tbmetodopago` VALUES (" . $nextId . ",'" .
                $metodopago->getNombre() . "','" .
                $metodopago->getDescripcion() . "','" .
                $metodopago->getActivo() . "');";

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        return $result;
    }

    public function updateTBMetodoPago($metodopago)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');


        $queryUpdate = "UPDATE tbmetodopago SET `tbmetodopagonombre`='" . $metodopago->getNombre() .
            "', `tbmetodopagodescripcion`='" . $metodopago->getDescripcion() .
            "', `tbmetodopagoactivo`='" . $metodopago->getActivo() .
            "' WHERE tbmetodopagoid=" .  $metodopago->getId() . ";";
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }


    public function deleteTBMetodoPago($idmetodopago)
    {

        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryDelete = "UPDATE `tbmetodopago` SET `tbmetodopagoactivo`= 0 WHERE `tbmetodopagoid` = " . $idmetodopago . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $result;
    }

    public function getAllTBMetodoPagos()
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbmetodopago WHERE tbmetodopagoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $metodopagos = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentMetodoPago = new MetodoPago($row['tbmetodopagoid'], $row['tbmetodopagonombre'], $row['tbmetodopagodescripcion'], $row['tbmetodopagoactivo']);
                array_push($metodopagos, $currentMetodoPago);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }



        return $metodopagos;
    }

    public function getAllTBMetodoPagoDesactivado()
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbmetodopago WHERE tbmetodopagoactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $metodopagos = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentMetodoPago = new MetodoPago($row['tbmetodopagoid'], $row['tbmetodopagonombre'], $row['tbmetodopagodescripcion'], $row['tbmetodopagoactivo']);
                array_push($metodopagos, $currentMetodoPago);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $metodopagos;
    }

    //traer un metodo de pago por id
    public function getTBMetodoPagoById($idmetodopago)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbmetodopago WHERE tbmetodopagoid = " . $idmetodopago;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentMetodoPago = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentMetodoPago = new MetodoPago($row['tbmetodopagoid'], $row['tbmetodopagonombre'], $row['tbmetodopagodescripcion'], $row['tbmetodopagoactivo']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return $currentMetodoPago;
    }

    public function getTBMetodoPagoByName($nombre)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbmetodopago WHERE tbmetodopagonombre = '" . $nombre . "'";
          
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentMetodoPago = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentMetodoPago = new MetodoPago($row['tbmetodopagoid'], $row['tbmetodopagonombre'], $row['tbmetodopagodescripcion'], $row['tbmetodopagoactivo']);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        
        return $currentMetodoPago;
    }



}

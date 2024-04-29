<?php


include_once 'Data.php';
include '../domain/Tarifa.php';

class TarifaData extends Data
{


    public function insertTBTarifa($tarifa)
    {

        // try - cath para manejar las excepciones
        try {

            $arrayTarifa = $this->getAllTBTarifas();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryGetLastId = "SELECT MAX(tbserviciotarifaid) AS tarifaid  FROM `tbserviciotarifa`";
            if (!empty($arrayTarifa)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbserviciotarifa` VALUES (" . $nextId . ",'" .
                $tarifa->getFechaModificada() . "','" .
                $tarifa->getMonto() . "','" .
                $tarifa->getActivo() . "');";

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBTarifa($tarifa)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE `tbserviciotarifa` SET `tbserviciotarifafechaactualizada`='" . $tarifa->getFechaModificada() .
                "', `tbserviciotarifamonto`='" . trim($tarifa->getMonto() , '₡') .
                "', `tbserviciotarifaactivo`='" . $tarifa->getActivo() .
                "' WHERE `tbserviciotarifaid` =" .  $tarifa->getIdTarifa() . ";";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function deleteTBTarifa($idtarifa)
    {


        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbserviciotarifa` SET `tbserviciotarifaactivo`= 0 WHERE `tbserviciotarifaid` = " . $idtarifa . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function getAllTBTarifas()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbserviciotarifa WHERE tbserviciotarifaactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $tarifas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentTarifa = new Tarifa($row['tbserviciotarifaid'], $row['tbserviciotarifafechaactualizada'], $row['tbserviciotarifamonto'], $row['tbserviciotarifaactivo']);
                array_push($tarifas, $currentTarifa);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $tarifas;
    }

    public function getAllTBTarifaDesactivada()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbserviciotarifa WHERE tbserviciotarifaactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $tarifas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentTarifa = new Tarifa($row['tbserviciotarifaid'], $row['tbserviciotarifafechaactualizada'], $row['tbserviciotarifamonto'], $row['tbserviciotarifaactivo']);
                array_push($tarifas, $currentTarifa);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $tarifas;
    }

    //Metodo para buscar una tarifa por su id

    public function getTBTarifaById($idtarifa)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbserviciotarifa WHERE tbserviciotarifaid = " . $idtarifa . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentTarifa = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentTarifa = new Tarifa($row['tbserviciotarifaid'], $row['tbserviciotarifafechaactualizada'], $row['tbserviciotarifamonto'], $row['tbserviciotarifaactivo']);
               
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $currentTarifa;
    }


}

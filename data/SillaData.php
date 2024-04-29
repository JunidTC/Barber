<?php


include_once 'Data.php';
include '../domain/Silla.php';

class SillaData extends Data
{


    public function insertTBSilla($silla)
    {


        // try - cath para manejar las excepciones
        try {
            $arraySillas = $this->getAllTBSillas();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbsillaid) AS sillaid  FROM tbsilla";
            if (!empty($arraySillas)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbsilla` VALUES (" . $nextId . ",'" .
                $silla->getSerie() . "','" .
                $silla->getMarca() . "','" .
                $silla->getModelo() . "','" .
                $silla->getPrecioCompra() . "','" .
                $silla->getActivo() . "');";
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBSilla($silla)
    {


        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbsilla SET `tbsillaserie`='" . $silla->getSerie() .
                "', `tbsillamarca`='" . $silla->getMarca() .
                "', `tbsillamodelo`='" . $silla->getModelo() .
                "', `tbsillapreciocompra`='" . trim($silla->getPrecioCompra(),'₡') .
                "', `tbsillaactivo`='" . $silla->getActivo() .
                "' WHERE tbsillaid=" .  $silla->getIdsilla() . ";";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function deleteTBSilla($idsilla)
    {

        //try -cath para manejar excepciones
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryDelete = "UPDATE `tbsilla` SET `tbsillaactivo`= 0 WHERE `tbsillaid` = " . $idsilla . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function getAllTBSillas()
    {
        //try -cath para manejar excepciones
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');


            $querySelect = "SELECT * FROM tbsilla WHERE tbsillaactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $sillas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentSilla = new Silla($row['tbsillaid'], $row['tbsillaserie'], $row['tbsillamarca'], $row['tbsillamodelo'], $row['tbsillapreciocompra'], $row['tbsillaactivo']);

                array_push($sillas, $currentSilla);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $sillas;
    }

    public function getAllTBSillasDesactivados()
    {
        //try -cath para manejar excepciones
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbsilla WHERE tbsillaactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $sillas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentSilla = new Silla($row['tbsillaid'], $row['tbsillaserie'], $row['tbsillamarca'], $row['tbsillamodelo'], $row['tbsillapreciocompra'], $row['tbsillaactivo']);
                array_push($sillas, $currentSilla);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $sillas;
    }
}

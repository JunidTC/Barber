<?php
include_once 'Data.php';
include '../domain/Cita.php';

class CitaData extends Data
{

    public function getAllTBCitas()
    {

        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbcita";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $citas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCita = new Cita($row['tbcitaid'], $row['tbbarberoid'], $row['tbclienteid'], $row['tbcitafecha'], $row['tbcitahora'], $row['tbcitaactivo'], $row['tbservicioid']);

                array_push($citas, $currentCita);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $citas;
    }

    public function insertTBCita($cita)
    {
        // try - cath para manejar las excepciones
        try {

            $arrayCitas = $this->getAllTBCitas();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbcitaid) AS tbcitaid  FROM tbcita";
            if (!empty($arrayCitas)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }

            $queryInsert = "INSERT INTO `tbcita` VALUES (" . $nextId . ",'" .
                $cita->getHora() . "'," .
                $cita->getBarberoId() . "," .
                $cita->getServicioId() . "," .
                $cita->getActivo() . "," .
                $cita->getClienteId() . ",'" .
                $cita->getFecha() . "')";
               
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBCita($cita)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbcita SET `tbbarberoid`=" . $cita->getBarberoId() .
                ",`tbclienteid`=" . $cita->getClienteId() .
                ",`tbcitafecha`='" . $cita->getFecha() .
                "',`tbcitahora`='" . $cita->getHora() .
                "',`tbcitaactivo`=" . $cita->getActivo() .
                ",`tbservicioid`=" . $cita->getServicioId() .
                " WHERE `tbcitaid`=" . $cita->getCitaId();

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBCita($citaId)
    {
        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE tbcita SET `tbcitaactivo`=0 WHERE `tbcitaid`=" . $citaId;
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function getTBCitaById($citaId)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbcita WHERE tbcitaid = " . $citaId;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentCita = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentCita = new Cita($row['tbcitaid'], $row['tbbarberoid'], $row['tbclienteid'], $row['tbcitafecha'], $row['tbcitahora'], $row['tbcitaactivo'], $row['tbservicioid']);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $currentCita;
    }
    //traer citas por barbero y fecha
    public function getTBCitaByBarberoFecha($barberoId, $fecha)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbcita WHERE tbbarberoid = " . $barberoId . " AND tbcitafecha = '" . $fecha . "'";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $citas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCita = new Cita($row['tbcitaid'], $row['tbbarberoid'], $row['tbclienteid'], $row['tbcitafecha'], $row['tbcitahora'], $row['tbcitaactivo'], $row['tbservicioid']);

                array_push($citas, $currentCita);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $citas;
    }

    public function getAllTBCitasAgrupadas()
    {

        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM `tbcita` GROUP BY tbclienteid";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $citas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCita = new Cita($row['tbcitaid'], $row['tbbarberoid'], $row['tbclienteid'], $row['tbcitafecha'], $row['tbcitahora'], $row['tbcitaactivo'], $row['tbservicioid']);

                array_push($citas, $currentCita);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $citas;
    }
    
    // traer citas por id de barbero

    public function getTBCitaByBarberoId($barberoId)
    {
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');

            //traer todas las citas agrupadas por fecha de un barbero
            $querySelect = "SELECT * FROM tbcita WHERE tbbarberoid = " . $barberoId . " GROUP BY tbcitafecha";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $citas = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCita = new Cita($row['tbcitaid'], $row['tbbarberoid'], $row['tbclienteid'], $row['tbcitafecha'], $row['tbcitahora'], $row['tbcitaactivo'], $row['tbservicioid']);

                array_push($citas, $currentCita);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $citas;
    }

}

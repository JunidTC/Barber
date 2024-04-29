<?php


include_once 'Data.php';
include '../domain/Servicio.php';

class ServicioData extends Data
{

    public function insertTBServicio($servicio)
    {


        // try - cath para manejar las excepciones  
        try {

            $arrayServicio = $this->getAllTBServicios();

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryGetLastId = "SELECT MAX(tbservicioid) AS servicioid  FROM tbservicio";
            if (!empty($arrayServicio)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbservicio` VALUES (" . $nextId . ",'" .
                $servicio->getNombre() . "','" .
                $servicio->getDescripcion() . "'," .
                $servicio->getActivo() . ",".
                $servicio->getTarifaId() . ",".
                $servicio->getDuracion() . ");";
                
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBServicio($servicio)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE `tbservicio` SET `tbservicionombre`='" . $servicio->getNombre() .
                "', `tbserviciodescripcion`='" . $servicio->getDescripcion() .
                "', `tbservicioactivo`=" . $servicio->getActivo() .
                ", `tbserviciotarifaid`=" . trim($servicio->getTarifaId(),'₡') .
                ", `tbservicioduracion`=" . $servicio->getDuracion() .
                " WHERE `tbservicioid` =" .  $servicio->getIdServicio() . ";";
              
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function deleteTBServicio($idservicio)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbservicio` SET`tbservicioactivo`= 0 WHERE `tbservicioid` =" . $idservicio . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function getAllTBServicios()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbservicio WHERE tbservicioactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $servicios = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentServicio = new Servicio($row['tbservicioid'], $row['tbservicionombre'], $row['tbserviciodescripcion'], $row['tbservicioactivo'], $row['tbserviciotarifaid'], $row['tbservicioduracion']);
                array_push($servicios, $currentServicio);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $servicios;
    }

    public function getAllTBServicioDesactivado()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbservicio WHERE tbservicioactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $servicios = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentServicio = new Servicio($row['tbservicioid'], $row['tbservicionombre'], $row['tbserviciodescripcion'], $row['tbservicioactivo'], $row['tbserviciotarifaid'],$row['tbservicioduracion']);
                array_push($servicios, $currentServicio);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $servicios;
    }

    //traer un servicio por id

    public function getTBServicioById($idservicio)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbservicio WHERE tbservicioid = " . $idservicio . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentServicio = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentServicio = new Servicio($row['tbservicioid'], $row['tbservicionombre'], $row['tbserviciodescripcion'], $row['tbservicioactivo'], $row['tbserviciotarifaid'],$row['tbservicioduracion']);
               
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $currentServicio;
    }



}

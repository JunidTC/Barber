<?php


include_once 'Data.php';
include '../domain/ClienteTipo.php';

class ClienteTipoData extends Data
{

    public function insertTBClienteTipo($clienteTipo)
    {


        // try - cath para manejar las excepciones
        try {
            $arrayClienteTipo = $this->getAllTBClientesTipo();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbclientetipoid) AS clientetipoid  FROM tbclientetipo";
            if (!empty($arrayClienteTipo)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbclientetipo` VALUES (" . $nextId . ",'" .
                $clienteTipo->getPeriodicidad() . "','" .
                $clienteTipo->getCancelacion() . "','" .
                $clienteTipo->getIngreso() . "','" .
                $clienteTipo->getPuntaje() . "','" .
                $clienteTipo->getActivo() . "');";

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function updateTBClienteTipo($clienteTipo)
    {
        

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            echo $queryUpdate = "UPDATE tbclientetipo SET `tbclientetipoperiodicidad`='" . $clienteTipo->getPeriodicidad() .
                "', `tbclientetipocancelacion`='" . $clienteTipo->getCancelacion() .
                "', `tbclientetipoingresomensual`='" . trim($clienteTipo->getIngreso(),'₡') .
                "', `tbclientetipopuntaje`='" . $clienteTipo->getPuntaje() .
                "', `tbclientetipoactivo`='" . $clienteTipo->getActivo() .
                "' WHERE tbclientetipoid=" .  $clienteTipo->getClienteTipoId(). ";";
             

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function deleteTBClienteTipo($idclientetipo)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbclientetipo` SET `tbclientetipoactivo`= 0 WHERE `tbclientetipoid` = " . $idclientetipo . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function getAllTBClientesTipo()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbclientetipo WHERE tbclientetipoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientesTipo = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentClienteTipo = new ClienteTipo($row['tbclientetipoid'], $row['tbclientetipoperiodicidad'], $row['tbclientetipocancelacion'], $row['tbclientetipoingresomensual'], $row['tbclientetipopuntaje'], $row['tbclientetipoactivo']);
                array_push($clientesTipo, $currentClienteTipo);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }
        
        
        return $clientesTipo;
    }

    public function getAllTBClienteTipoDesactivado()
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbclientetipo WHERE tbclientetipoactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientesTipo = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentClienteTipo = new ClienteTipo($row['tbclientetipoid'], $row['tbclientetipoperiodicidad'], $row['tbclientetipocancelacion'], $row['tbclientetipoingresomensual'], $row['tbclientetipopuntaje'], $row['tbclientetipoactivo']);
                array_push($clientesTipo, $currentClienteTipo);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $clientesTipo;
    }

    public function getTBTipoClienteById($idTipo)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbclientetipo WHERE tbclientetipoid = " . $idTipo . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentServicio = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentServicio = new ClienteTipo($row['tbclientetipoid'], $row['tbclientetipoperiodicidad'], $row['tbclientetipocancelacion'], $row['tbclientetipoingresomensual'], $row['tbclientetipopuntaje'], $row['tbclientetipoactivo']);
               
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $currentServicio;
    }
}


<?php
include_once 'Data.php';
include '../domain/Abono.php';

class AbonoData extends Data
{ 

    public function getAllTBAbonos()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbabono";//"SELECT * FROM tbcredito WHERE tbcreditoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $abonos = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentAbono = new Abono($row['tbabonoid'], $row['tbabonofecha'], $row['tbabonomonto'], $row['tbcreditoid']);
                
                array_push($abonos, $currentAbono);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $abonos;
    }
   
    public function insertTBAbono($abono)
    {
        // try - cath para manejar las excepciones
        try {
            
            $arrayAbonos = $this->getAllTBAbonos();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbabonoid) AS tbabonoid  FROM tbabono";
            if (!empty($arrayAbonos)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            
            $queryInsert = "INSERT INTO `tbabono` VALUES (" . $nextId . ",'" .
                $abono->getFecha() . "'," .
                $abono->getMonto() . "," .
                $abono->getCreditoId() .");";
            
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBAbono($abono)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbabono SET `tbabonofecha`='" . $abono->getFecha() .
                "', `tbabonomonto`=" . $abono->getMonto() .
                ", `tbcreditoid`=" . $abono->getCreditoId() .
                " WHERE tbabonoid=" .  $abono->getAbonoId() . "";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBAbono($abonoId)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "DELETE FROM `tbabono` WHERE `tbabonoid` = " . $abonoId . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   
        return $result;
    }

    public function getTBAbonoById($abonoId)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbabono WHERE tbabonoid = " . $abonoId ;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentAbono = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentAbono = new Abono($row['tbabonoid'], $row['tbabonofecha'], $row['tbabonomonto'], $row['tbcreditoid']);
                
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   
        return $currentAbono;
    }

}
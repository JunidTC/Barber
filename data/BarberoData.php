<?php


include_once 'Data.php';
include '../domain/Barbero.php';

class BarberoData extends Data
{


    public function insertTBBarbero($barbero)
    {

        // try - cath para manejar las excepciones
        try {
            
            $arraybarbero = $this->getAllTBbarbero();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id

            $queryGetLastId = "SELECT MAX(tbbarberoid) AS tbbarberoid  FROM tbbarbero";

            if (!empty($arraybarbero)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }


            

            $queryInsert = "INSERT INTO `tbbarbero` VALUES (" . $nextId . ",'" .

                $barbero->getNombre() . "'," .           
                $barbero->getTelefono() . ",'" .
                $barbero->getEmail() . "'," .
                $barbero->getActivo() . ");";

                

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBbarbero($barbero)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryUpdate = "UPDATE tbbarbero SET `tbbarberonombre`='" . $barbero->getNombre() .
                "', `tbbarberotelefono`=" . $barbero->getTelefono() .
                ", `tbbarberocorreo`='" . $barbero->getEmail() .
                "', `tbbarberoactivo`=" . $barbero->getActivo() .
                " WHERE tbbarberoid=" .  $barbero->getBarberoId() . ";";

             

               
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBBarbero($barberoId)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryDelete = "UPDATE `tbbarbero` SET `tbbarberoactivo`= 0 WHERE `tbbarberoId` = " . $barberoId . ";";

            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $result;
    }

    public function getAllTBbarbero()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    

            $querySelect = "SELECT * FROM tbbarbero WHERE tbbarberoactivo = 1";

            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $barbero = [];
            while ($row = mysqli_fetch_array($result)) {

                $currentbarbero = new Barbero($row['tbbarberoid'], $row['tbbarberonombre'],  $row['tbbarberotelefono'], $row['tbbarberocorreo'], $row['tbbarberoactivo']);

                array_push($barbero, $currentbarbero);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $barbero;
    }

    public function getAllTBBarberoDesactivado()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    

            $querySelect = "SELECT * FROM tbbarbero WHERE tbbarberoactivo = 0";

            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $barbero = [];
            while ($row = mysqli_fetch_array($result)) {

                $currentbarbero = new Barbero($row['tbbarberoid'], $row['tbbarberonombre'], $row['tbbarberotelefono'], $row['tbbarberocorreo'], $row['tbbarberoactivo']);

                array_push($barbero, $currentbarbero);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $barbero;
    }


    //Metodo para buscar un barbero por su id
    public function getTBBarberoById($id)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbbarbero WHERE tbbarberoid = " . $id . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $row = mysqli_fetch_array($result);


            $currentBarbero= new Barbero($row['tbbarberoid'], $row['tbbarberonombre'], $row['tbbarberotelefono'], $row['tbbarberocorreo'], $row['tbbarberoactivo']);


        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $currentBarbero;
    }

}



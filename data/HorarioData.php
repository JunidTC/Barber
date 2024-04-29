<?php
include_once 'Data.php';
include '../domain/Horario.php';

class HorarioData extends Data
{ 

    public function getAllTBHorarios()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbhorario";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $horario = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentHorario = new Horario($row['tbhorarioid'], $row['tbbarberoid'], $row['tbhorariodia'], $row['tbhorarioinicial'],$row['tbhorariofinal'],$row['tbhorarioactivo']);
                
                array_push($horario, $currentHorario);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $horario;
    }
   
    public function insertTBHorario($horario)
    {
        // try - cath para manejar las excepciones
        try {
            
            $arrayHorarios = $this->getAllTBHorarios();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbhorarioid) AS tbhorarioid  FROM tbhorario";
            if (!empty($arrayHorarios)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            
            $queryInsert = "INSERT INTO `tbhorario` VALUES (" . $nextId . "," .
                $horario->getBarberoId() . "," .
                $horario->getFecha() . ",'" . 
                $horario->getFechaInicial() . "','" . 
                $horario->getFechaFinal() . "'," .    
                $horario->getActivo() .");";
             
            
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBHorario($horario)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbhorario SET `tbbarberoid`=" . $horario->getBarberoId() .
                ",`tbhorariodia`=" . $horario->getFecha() .
                ", `tbhorarioinicial`='" . $horario->getFechaInicial() .
                "', `tbhorariofinal`='" . $horario->getFechaFinal() .
                "', `tbhorarioactivo`=" . $horario->getActivo() .
                " WHERE tbhorarioid=" .  $horario->getHorarioId() . "";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBHorario($horarioId)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "DELETE FROM `tbhorario` WHERE `tbhorarioid` = " . $horarioId . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   
        return $result;
    }

    public function getTBHorarioById($horarioId)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbhorario WHERE tbhorarioid = " . $horarioId ;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentHorario = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentHorario = new Horario($row['tbhorarioid'], $row['tbbarberoid'], $row['tbhorariodia'], $row['tbhorarioinicial'], $row['tbhorariofinal'], $row['tbhorarioactivo']);
                
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   
        return $currentHorario;
    }

    //traer horarios por un dia especifico
    public function getTBHorarioByDay($dia, $idBarbero)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbhorario WHERE tbhorariodia = " . $dia  . " AND tbbarberoid = " . $idBarbero;
          
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentHorario = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentHorario = new Horario($row['tbhorarioid'], $row['tbbarberoid'], $row['tbhorariodia'], $row['tbhorarioinicial'], $row['tbhorariofinal'], $row['tbhorarioactivo']);
            }
            
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   
        
        return $currentHorario;
    }

}
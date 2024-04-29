<?php

include_once 'Data.php';
include '../domain/ClienteCategoria.php';

class ClienteCategoriaData extends Data
{

    public function insertTBClienteCategoria($clienteCategoria)
    {
        try {
            $arrayClientesCategoria = $this->getAllTBClientesCategoria();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbclientecategoriaid) AS clientecategoriaid  FROM tbclientecategoria";
            if (!empty($arrayClientesCategoria)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            $queryInsert = "INSERT INTO `tbclientecategoria` VALUES (" . $nextId . ",'" .
                $clienteCategoria->getDescripcion() . "'," .
                $clienteCategoria->getActivo() . ",'" .
                $clienteCategoria->getNombreCategoria() . "'," .
                $clienteCategoria->getClienteTipoId() . ");";

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }

        return $result;
    }

    public function updateTBClienteCategoria($clienteCategoria)
    {   
        

        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbclientecategoria SET `tbclientecategoriadescripcion`='" . $clienteCategoria->getDescripcion() .
                "', `tbclientecategorianombre`='" . $clienteCategoria->getNombreCategoria() .
                "', `tbclientecategoriaactivo`=" . $clienteCategoria->getActivo() .
                ", `tbclientetipoid`=" . $clienteCategoria->getClienteTipoId() .
                " WHERE tbclientecategoriaid=" .  $clienteCategoria->getId() . ";";
                
               
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBClienteCategoria($clientecategoriaid)
    {

        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbclientecategoria` SET `tbclientecategoriaactivo`= 0 WHERE `tbclientecategoriaid` = " . $clientecategoriaid . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        return $result;
    }

    public function getAllTBClientesCategoria()
    {
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientes = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCliente = new ClienteCategoria($row['tbclientecategoriaid'], $row['tbclientecategoriadescripcion'], $row['tbclientecategoriaactivo'], $row['tbclientecategorianombre'], $row['tbclientetipoid']);
                array_push($clientes, $currentCliente);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }


        return $clientes;
    }

    public function getAllTBClienteCategoriaDesactivado()
    {
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientes = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCliente = new ClienteCategoria($row['tbclientecategoriaid'], $row['tbclientecategoriadescripcion'], $row['tbclientecategoriaactivo'], $row['tbclientecategorianombre'], $row['tbclientetipoid']);
                array_push($clientes, $currentCliente);
            }
        } catch (Exception $e) {

            return $e->getMessage();
        }


        return $clientes;
    }



    //trae un clientecategoria por id

    public function getTBClienteCategoriaById($clientecategoriaid)
    {
        try {

            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbclientecategoria WHERE tbclientecategoriaid = " . $clientecategoriaid;
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentCliente = null;
            
            while ($row = mysqli_fetch_assoc($result)) {
                $currentCliente = new ClienteCategoria($row['tbclientecategoriaid'], $row['tbclientecategoriadescripcion'], $row['tbclientecategoriaactivo'], $row['tbclientecategorianombre'], $row['tbclientetipoid']);
                
            }
            
        } catch (Exception $e) {

            return $e->getMessage();
        }
        
        return $currentCliente;
           
   

    }


    
}

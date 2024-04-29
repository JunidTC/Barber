<?php


include_once 'Data.php';
include '../domain/Cliente.php';

class ClienteData extends Data
{


    public function insertTBCliente($cliente)
    {

        // try - cath para manejar las excepciones
        try {
            
            $arrayCliente = $this->getAllTBClientes();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbclienteid) AS clienteid  FROM tbcliente";
            if (!empty($arrayCliente)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            
            $queryInsert = "INSERT INTO `tbcliente` VALUES (" . $nextId . ",'" .
                $cliente->getNombre() . "','" .
                $cliente->getApellido() . "'," .
                $cliente->getNumeroTelefono() . ",'" .
                $cliente->getCorreo() . "'," .
                $cliente->getActivo() . ",".
                $cliente->getClienteCategoriaId() . ");";

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBCliente($cliente)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbcliente SET `tbclientenombre`='" . $cliente->getNombre() .
                "', `tbclienteapellido`='" . $cliente->getApellido() .
                "', `tbclientetelefono`=" . $cliente->getNumeroTelefono() .
                ", `tbclientecorreo`='" . $cliente->getCorreo() .
                "', `tbclienteactivo`=" . $cliente->getActivo() .
                ", `tbclientecategoriaid`=" . $cliente->getClienteCategoriaId() .
                " WHERE tbclienteid=" .  $cliente->getId() . ";";

            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBCliente($idcliente)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbcliente` SET `tbclienteactivo`= 0 WHERE `tbclienteid` = " . $idcliente . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $result;
    }

    public function getAllTBClientes()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbcliente WHERE tbclienteactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientes = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCliente = new Cliente($row['tbclienteid'], $row['tbclientenombre'], $row['tbclienteapellido'], $row['tbclientetelefono'], $row['tbclientecorreo'], $row['tbclienteactivo'], $row['tbclientecategoriaid']);
                array_push($clientes, $currentCliente);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $clientes;
    }

    public function getAllTBClienteDesactivado()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbcliente WHERE tbclienteactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientes = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCliente = new Cliente($row['tbclienteid'], $row['tbclientenombre'], $row['tbclienteapellido'], $row['tbclientetelefono'], $row['tbclientecorreo'], $row['tbclienteactivo'], $row['tbclientecategoriaid']);
                array_push($clientes, $currentCliente);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $clientes;
    }


    //Metodo para buscar un cliente por su id
    public function getTBClienteById($id)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $querySelect = "SELECT * FROM tbcliente WHERE tbclienteid = " . $id . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $row = mysqli_fetch_array($result);
            $currentCliente = new Cliente($row['tbclienteid'], $row['tbclientenombre'], $row['tbclienteapellido'], $row['tbclientetelefono'], $row['tbclientecorreo'], $row['tbclienteactivo'], $row['tbclientecategoriaid']);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $currentCliente;
    }

}



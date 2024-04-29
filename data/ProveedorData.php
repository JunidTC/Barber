<?php


include_once 'Data.php';
include '../domain/Proveedor.php';

class ProveedorData extends Data
{


    public function insertTBProveedor($proveedor)
    {

        // try - cath para manejar las excepciones
        try {
            
            $arrayProveedor = $this->getAllTBProveedor();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id

            $queryGetLastId = "SELECT MAX(tbproveedorid) AS provedorid  FROM tbproveedor";

            if (!empty($arrayProveedor)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }


            

            $queryInsert = "INSERT INTO `tbproveedor` VALUES (" . $nextId . ",'" .

                $proveedor->getNombre() . "','" .
                $proveedor->getLineaProducto() . "'," .
                $proveedor->getTelefono() . ",'" .
                $proveedor->getEmail() . "','" .
                $proveedor->getDireccion() . "',".
                $proveedor->getActivo() . ");";

                

            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBProveedor($proveedor)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryUpdate = "UPDATE tbproveedor SET `tbproveedornombre`='" . $proveedor->getNombre() .
                "', `tbproveedorlineaproducto`='" . $proveedor->getLineaProducto() .
                "', `tbproveedortelefono`=" . $proveedor->getTelefono() .
                ", `tbproveedorcorreo`='" . $proveedor->getEmail() .
                "', `tbproveedordireccion`='" . $proveedor->getDireccion() .
                "', `tbproveedoractivo`=" . $proveedor->getActivo() .
                " WHERE tbproveedorid=" .  $proveedor->getProveedorId() . ";";

               
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBProveedor($proveedorId)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $queryDelete = "UPDATE `tbproveedor` SET `tbproveedoractivo`= 0 WHERE `tbproveedorid` = " . $proveedorId . ";";

            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $result;
    }

    public function getAllTBProveedor()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    

            $querySelect = "SELECT * FROM tbproveedor WHERE tbproveedoractivo = 1";

            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $proveedor = [];
            while ($row = mysqli_fetch_array($result)) {

                $currentProveedor = new Proveedor($row['tbproveedorid'], $row['tbproveedornombre'], $row['tbproveedorlineaproducto'], $row['tbproveedortelefono'], $row['tbproveedorcorreo'], $row['tbproveedordireccion'], $row['tbproveedoractivo']);

                array_push($proveedor, $currentProveedor);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $proveedor;
    }

    public function getAllTBProveedorDesactivado()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    

            $querySelect = "SELECT * FROM tbproveedor WHERE tbproveedoractivo = 0";

            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $proveedor = [];
            while ($row = mysqli_fetch_array($result)) {

                $currentProveedor = new Proveedor($row['tbproveedorid'], $row['tbproveedornombre'], $row['tbproveedorlineaproducto'], $row['tbproveedortelefono'], $row['tbproveedorcorreo'], $row['tbproveedordireccion'], $row['tbproveedoractivo']);

                array_push($proveedor, $currentProveedor);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $proveedor;
    }


    //Metodo para buscar un provedor por su id
    public function getTBProveedorById($id)
    {
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            $querySelect = "SELECT * FROM tbproveedor WHERE tbproveedorid = " . $id . ";";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $row = mysqli_fetch_array($result);
            $currentProveedor= new Proveedor($row['tbproveedorid'], $row['tbproveedornombre'], $row['tbproveedorlineaproducto'], $row['tbproveedortelefono'], $row['tbproveedorcorreo'], $row['tbproveedordireccion'], $row['tbproveedoractivo']);

        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $currentProveedor;
    }

}



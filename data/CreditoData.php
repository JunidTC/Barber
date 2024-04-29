<?php
include_once 'Data.php';
include '../domain/Credito.php';
include '../domain/DetalleCredito.php';

class CreditoData extends Data
{ 


    public function getAllTBCreditos()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
            $querySelect = "SELECT cli.tbclientenombre,c.tbcreditoid, f.tbfacturafecha,
             f.tbfacturaid, c.tbcreditomontototal,c.tbcreditofechalimite 
             from tbcredito as c 
             INNER JOIN tbfactura as f ON c.tbcreditofacturaid = f.tbfacturaid 
             INNER JOIN tbcliente AS cli ON cli.tbclienteid = f.tbclienteid 
             WHERE c.tbcreditoactivo = 1 ORDER BY cli.tbclientenombre ASC, 
             f.tbfacturafecha ASC";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $DetalleCredito = [];
            while ($row = mysqli_fetch_array($result)) {
                $currentCredito = new DetalleCredito(
                    $row['tbclientenombre'],
                    $row['tbfacturafecha'],
                    $row['tbcreditomontototal'],
                    $row['tbcreditofechalimite'],
                    $row['tbfacturaid'],
                    $row['tbcreditoid']
                );
                array_push($DetalleCredito, $currentCredito);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $DetalleCredito;
    }
   
    public function insertTBCredito($credito)
    {

        
      
        // try - cath para manejar las excepciones
        try {
            
            $arrayCreditos = $this->getAllTBCreditos();
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');

            //Get the last id
            $queryGetLastId = "SELECT MAX(tbcreditoid) AS tbcreditoid  FROM tbcredito";
            if (!empty($arrayCreditos)) {
                $idCont = mysqli_query($conn, $queryGetLastId);
                if ($row = mysqli_fetch_row($idCont)) {
                    $nextId = trim($row[0]) + 1;
                }
            } else {
                $nextId = 1;
            }
            
            $queryInsert = "INSERT INTO `tbcredito` VALUES (" . $nextId . "," .
                $credito->getCreditoFacturaId() . ",'" .
                $credito->getFechaLimite() . "'," .
                $credito->getCancelacion() . "," .
                $credito->getActivo() ."," .
                $credito->getMontoCredito() .");";
            
            $result = mysqli_query($conn, $queryInsert);
            mysqli_close($conn);
        } catch (Exception $e) {

            return $e->getMessage();
        }
        return $result;
    }

    public function updateTBCredito($credito)
    {

        //try -cath para manejar excepciones
        try {
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryUpdate = "UPDATE tbcredito SET `tbcreditofacturaid`=" . $credito->getCreditoFacturaId() .
                ", `tbcreditofechalimite`='" . $credito->getFechaLimite() .
                "', `tbcreditocancelacion`=" . $credito->getCancelacion() .
                ", `tbcreditoactivo`=" . $credito->getActivo() .
                ", `tbcreditomontototal`=" . $credito->getMontoCredito() .
                " WHERE tbcreditoid=" .  $credito->getCreditoId() . ";";

                
            $result = mysqli_query($conn, $queryUpdate);
            mysqli_close($conn);
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return $result;
    }

    public function deleteTBCredito($creditoid)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "UPDATE `tbcredito` SET `tbcreditoactivo` = 0,`tbcreditocancelacion`= 2 WHERE `tbcreditoid` = " . $creditoid . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $result;
    }

    public function deleteTBCreditoDelete($creditoid)
    {
        //try -cath para manejar excepciones
        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
            $conn->set_charset('utf8');
            $queryDelete = "DELETE FROM tbcredito WHERE `tbcreditoid` = " . $creditoid . ";";
            $result = mysqli_query($conn, $queryDelete);
            mysqli_close($conn);
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $result;
    }
    

    public function getAllTBCreditoDesactivado()
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbcredito WHERE tbcreditoactivo = 0";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $clientes = [];
            while ($row = mysqli_fetch_array($result)) {
                $currenteCredito = new Credito($row['tbcreditoid'], $row['tbcreditofacturaid'], $row['tbcreditofechalimite'], $row['tbcreditocancelacion'], $row['tbcreditoactivo'], $row['tbcreditomontototal']);
                array_push($clientes, $currenteCredito);
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $clientes;
    }

    public function getTBCreditoById($creditoid)
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbcredito WHERE tbcreditoid = " . $creditoid . " AND tbcreditoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentCredito = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentCredito = new Credito($row['tbcreditoid'], $row['tbcreditofacturaid'], $row['tbcreditofechalimite'], $row['tbcreditocancelacion'], $row['tbcreditoactivo'], $row['tbcreditomontototal']);
                
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $currentCredito;
    }

    public function foundTBCreditoByIdFactura($facturaId)
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT tbcreditoid FROM tbcredito WHERE tbcreditofacturaid = " . $facturaId . " AND tbcreditoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $creditoId = null;
            while ($row = mysqli_fetch_array($result)) {
                $creditoId = $row['tbcreditoid'];
                
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $creditoId;
    }

    //traer un credito por id de factura

    public function getTBCreditoByIdFactura($facturaId)
    {

        try{
            $conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);

            $conn->set_charset('utf8');
    
            $querySelect = "SELECT * FROM tbcredito WHERE tbcreditofacturaid = " . $facturaId . " AND tbcreditoactivo = 1";
            $result = mysqli_query($conn, $querySelect);
            mysqli_close($conn);
            $currentCredito = null;
            while ($row = mysqli_fetch_array($result)) {
                $currentCredito = new Credito($row['tbcreditoid'], $row['tbcreditofacturaid'], $row['tbcreditofechalimite'], $row['tbcreditocancelacion'], $row['tbcreditoactivo'], $row['tbcreditomontototal']);
                
            }
        } catch (Exception $e) {
        
            return $e->getMessage();
        }   

        return $currentCredito;
    }

}



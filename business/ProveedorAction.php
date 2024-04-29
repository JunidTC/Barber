<?php


include 'ProveedorBusiness.php';



if (isset($_POST['update'])) {
   

    if(str_contains ( $_POST['proveedorcorreo'] , "@")&&str_contains ( $_POST['proveedorcorreo'] , ".com") ){
            
        if (isset($_POST['proveedornombre']) && isset($_POST['proveedorlineaproducto'])  && isset($_POST['proveedortelefono']) && isset($_POST['proveedorcorreo']) && isset($_POST['proveedordireccion'])  && isset($_POST['proveedorid'])) {
            $nombre = $_POST['proveedornombre'];
            $lineaProducto = $_POST['proveedorlineaproducto'];
            $telefono = $_POST['proveedortelefono'];
            $correo =  $_POST['proveedorcorreo'];
            //$activo = isset($_POST['proveedoractivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
            $id = $_POST['proveedorid'];
            $direccion = $_POST['proveedordireccion'];
              
            
            if (strlen($nombre) > 0 && strlen($lineaProducto) > 0 && strlen($telefono) > 0  && strlen($correo) > 0 && strlen($direccion) > 0) {
                
                $proveedor = new Proveedor($id, $nombre,  $lineaProducto, $telefono, $correo, $direccion, 1);
                $proveedorBusiness = new ProveedorBusiness();
               
                
                $result = $proveedorBusiness->updateTBProveedor($proveedor);


                if ($result == 1) {
                    header("location: ../view/ProveedorView.php?success=updated");
                } else {
                    header("location: ../view/ProveedorView.php?error=dbError");
                }
            } else {
                header("location: ../view/ProveedorView.php?error=emptyField");
            }
        } 
    }else {
        header("location: ../view/ProveedorView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivado'])) {
   
    if (isset($_POST['proveedorid']) && isset($_POST['proveedornombre'])  && isset($_POST['proveedorlineaproducto']) && isset($_POST['proveedortelefono']) && isset($_POST['proveedorcorreo'])  && isset($_POST['proveedordireccion'])) {
        $nombre = $_POST['proveedornombre'];
        $lineaProducto = $_POST['proveedorlineaproducto'];
        $telefono = $_POST['proveedortelefono'];
        $correo =  $_POST['proveedorcorreo'];
        $activo = 1; // si el check fue marcado, será 1 
        $id = $_POST['proveedorid'];
        $direccion = $_POST['proveedordireccion'];

        if(!isset($_POST['proveedoractivo'])){
            $activo = 0;
        }
        
        if (strlen($nombre) > 0 && strlen($lineaProducto) > 0 && strlen($telefono) > 0  && strlen($correo) > 0 && strlen($direccion) > 0 ) {
            
            $proveedor = new Proveedor($id, $nombre,  $lineaProducto, $telefono, $correo, $direccion, $activo);
            
            $proveedorBusiness = new ProveedorBusiness();
            
            $result = $proveedorBusiness->updateTBProveedor($proveedor);

            if ($result == 1) {
                header("location: ../view/ProveedorView.php?success=updated");
            } else {
                header("location: ../view/ProveedorView.php?error=dbError");
            }
        } else {
            header("location: ../view/ProveedorView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ProveedorView.php?error=dbError");
    }
} else if (isset($_POST['delete'])) {

    if (isset($_POST['proveedorid'])) {

        $id = $_POST['proveedorid'];

        $proveedorBusiness = new ProveedorBusiness();
        $result = $proveedorBusiness->deleteTBProveedor($id);

        if ($result == 1) {
            header("location: ../view/ProveedorView.php?success=deleted");
        } else {
            header("location: ../view/ProveedorView.php?error=dbError");
        }
    } else {
        header("location: ../view/ProveedorView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar
   
    if (isset($_POST['proveedornombre']) && isset($_POST['proveedorlineaproducto']) && isset($_POST['proveedortelefono'])  && isset($_POST['proveedorcorreo'])  && isset($_POST['proveedordireccion'])) {
        //recibir valores y guardar en variables 

        $nombre = $_POST['proveedornombre'];
        $lineaProducto = $_POST['proveedorlineaproducto'];
        $telefono = $_POST['proveedortelefono'];
        $correo = $_POST['proveedorcorreo'];
        $direccion = $_POST['proveedordireccion'];

      

        //validando datos
        if (strlen($nombre) > 0 && strlen($lineaProducto) > 0 && strlen($telefono) > 0  && strlen($correo) > 0 && strlen($direccion) > 0) {
            //creando objeto
            $proveedor = new Proveedor(0, $nombre,  $lineaProducto, $telefono, $correo, $direccion, 1);

            $proveedorBusiness = new ProveedorBusiness();

            $result =  $proveedorBusiness->insertTBProveedor($proveedor);

            if ($result == 1) {
                header("location: ../view/ProveedorView.php?success=inserted");
            } else {
                header("location: ../view/ProveedorView.php?error=dbError");
            }
        } else {
            header("location: ../view/ProveedorView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ProveedorView.php?error=error");
    }
}

?>
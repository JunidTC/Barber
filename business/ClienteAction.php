<?php

include 'ClienteBusiness.php';



if (isset($_POST['update'])) {
  
        if (isset($_POST['clienteid']) && isset($_POST['clientenombre'])  && isset($_POST['clientenombre']) && isset($_POST['clienteapellido']) && isset($_POST['clientetelefono'])  && isset($_POST['clientecorreo']) && isset($_POST['clienteCategorias'])) {
            $nombre = $_POST['clientenombre'];
            $apellido = $_POST['clienteapellido'];
            $telefono = $_POST['clientetelefono'];
            $correo =  $_POST['clientecorreo'];
            $activo = isset($_POST['clienteactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
            $id = $_POST['clienteid'];
            $categoriaId = $_POST['clienteCategorias']['clienteCategoriaId'];
            
            
            if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($telefono) > 0  && strlen($correo) > 0) {
                
                $cliente = new Cliente($id, $nombre,  $apellido, $telefono, $correo, 1, $categoriaId);
                $clienteBusiness = new ClienteBusiness();
                $result = $clienteBusiness->updateTBCliente($cliente);

                if ($result == 1) {
                    header("location: ../view/ClienteView.php?success=updated");
                } else {
                    header("location: ../view/ClienteView.php?error=dbError");
                }
            } else {
                header("location: ../view/ClienteView.php?error=emptyField");
            }
        } else {
        header("location: ../view/ClienteView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivado'])) {
   
    if (isset($_POST['clienteid']) && isset($_POST['clientenombre'])  && isset($_POST['clientenombre']) && isset($_POST['clienteapellido']) && isset($_POST['clientetelefono'])  && isset($_POST['clientecorreo']) && isset($_POST['clienteCategoriaId'])) {
        $nombre = $_POST['clientenombre'];
        $apellido = $_POST['clienteapellido'];
        $telefono = $_POST['clientetelefono'];
        $correo =  $_POST['clientecorreo'];
        $activo = 1; // si el check fue marcado, será 1 
        $id = $_POST['clienteid'];
        $categoriaId = $_POST['clienteCategoriaId'];

        if(!isset($_POST['clienteactivo'])){
            $activo = 0;
        }
        
        if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($telefono) > 0  && strlen($correo) > 0) {
            
            $cliente = new Cliente($id, $nombre,  $apellido, $telefono, $correo, $activo, $categoriaId);
            
            $clienteBusiness = new ClienteBusiness();

            $result = $clienteBusiness->updateTBCliente($cliente);

            if ($result == 1) {
                header("location: ../view/ClienteView.php?success=updated");
            } else {
                header("location: ../view/ClienteView.php?error=dbError");
            }
        } else {
            header("location: ../view/ClienteView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteView.php?error=dbError");
    }
} else if (isset($_POST['delete'])) {

    if (isset($_POST['clienteid'])) {

        $id = $_POST['clienteid'];

        $clienteBusiness = new ClienteBusiness();
        $result = $clienteBusiness->deleteTBCliente($id);

        if ($result == 1) {
            header("location: ../view/ClienteView.php?success=deleted");
        } else {
            header("location: ../view/ClienteView.php?error=dbError");
        }
    } else {
        header("location: ../view/ClienteView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar
   
    if (isset($_POST['clientenombre']) && isset($_POST['clienteapellido']) && isset($_POST['clientetelefono'])  && isset($_POST['clientecorreo'])  && isset($_POST['clienteCategorias'])) {
        //recibir valores y guardar en variables 

        $nombre = $_POST['clientenombre'];
        $apellido = $_POST['clienteapellido'];
        $telefono = $_POST['clientetelefono'];
        $correo = $_POST['clientecorreo'];
        $categoriaId = $_POST['clienteCategorias']['clienteCategoriaId'];

      

        //validando datos
        if (strlen($nombre) > 0 && strlen($apellido) > 0 && strlen($telefono) > 0  && strlen($correo) > 0) {
            //creando objeto
            $cliente = new Cliente(0, $nombre,  $apellido, $telefono, $correo, 1, $categoriaId);

            $clienteBusiness = new ClienteBusiness();

            $result =  $clienteBusiness->insertTBCliente($cliente);

            if ($result == 1) {
                header("location: ../view/ClienteView.php?success=inserted");
            } else {
                header("location: ../view/ClienteView.php?error=dbError");
            }
        } else {
            header("location: ../view/ClienteView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteView.php?error=error");
    }
}

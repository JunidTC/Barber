<?php

include './ClienteCategoriaBusiness.php';

if (isset($_POST['update'])) {
    
    

    if (isset($_POST['clientecategoriaid']) && isset($_POST['clientecategoriadescripcion']) && isset($_POST['clientecategorianombre'])&& isset($_POST['clientecategoriatipoid']) ) {
        
        $descripcion = $_POST['clientecategoriadescripcion'];
        $activo = isset($_POST['clientecategoriaactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
        $categoriaNombre = $_POST['clientecategorianombre'];
        $id = $_POST['clientecategoriaid'] ;
        $tipoId = $_POST['clientecategoriatipoid'];
      
       
        
        if (strlen($descripcion) > 0  && strlen($categoriaNombre) > 0) {

            $clienteCategoria = new ClienteCategoria($id, $descripcion,  1 , $categoriaNombre,$tipoId);

                $clienteCategoriaBusiness = new ClienteCategoriaBusiness();
                

                $result = $clienteCategoriaBusiness->updateTBClienteCategoria($clienteCategoria);

                if ($result == 1) {
                    header("location: ../view/ClienteCategoriaView.php?success=updated");
                } else {
                    header("location: ../view/ClienteCategoriaView.php?error=dbError");
                }
        } else {
            header("location: ../view/ClienteCategoriaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteCategoriaView.php?error=Error");
    }
}else if (isset($_POST['updateDesactivado'])){
    if (isset($_POST['clientecategoriaid']) && isset($_POST['clientecategoriadescripcion']) && isset($_POST['clientecategorianombre']) && isset($_POST['clientecategoriatipoid'])) {
        $descripcion = $_POST['clientecategoriadescripcion'];
        $activo = 1; // si el check fue marcado, será 1, caso 
        $categoriaNombre = $_POST['clientecategorianombre'];
        $id = $_POST['clientecategoriaid'] ;
        $tipoId = $_POST['clientecategoriatipoid'];
        
        if(!isset($_POST['clientecategoriaactivo'])){
            $activo = 0;
        }
        
        if (strlen($descripcion) > 0  && strlen($categoriaNombre) > 0) {

            $clienteCategoria = new ClienteCategoria($id, $descripcion,  $activo , $categoriaNombre, $tipoId);

                $clienteCategoriaBusiness = new ClienteCategoriaBusiness();

                $result = $clienteCategoriaBusiness->updateTBClienteCategoria($clienteCategoria);

                if ($result == 1) {
                    header("location: ../view/ClienteCategoriaView.php?success=updated");
                } else {
                    header("location: ../view/ClienteCategoriaView.php?error=dbError");
                }
        } else {
            header("location: ../view/ClienteCategoriaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteCategoriaView.php?error=Error");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['clientecategoriaid'])) {

        $id = $_POST['clientecategoriaid'];

        $clienteCategoriaBusiness = new ClienteCategoriaBusiness();
        $result = $clienteCategoriaBusiness->deleteTBClienteCategoria($id);

        if ($result == 1) {
            header("location: ../view/ClienteCategoriaView.php?success=deleted");
        } else {
            header("location: ../view/ClienteCategoriaView.php?error=dbError");
        }
    } else {
        header("location: ../view/ClienteCategoriaView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['clientecategoriadescripcion']) && isset($_POST['clientecategorianombre']) && isset($_POST['clienteTipos'])) {
        $descripcion = $_POST['clientecategoriadescripcion'];
        $categoriaNombre = $_POST['clientecategorianombre'];
        $id = $_POST['clientecategoriaid'] ;
        $tipoId = $_POST['clienteTipos']['clienteTipoId'];
        
        if (strlen($descripcion) > 0 && strlen($categoriaNombre) > 0) {

            $clienteCategoria = new ClienteCategoria(0, $descripcion,  1 , $categoriaNombre, $tipoId);

            $clienteCategoriaBusiness = new ClienteCategoriaBusiness();

            $result = $clienteCategoriaBusiness->insertTBClienteCategoria($clienteCategoria);

            if ($result == 1) {
                header("location: ../view/ClienteCategoriaView.php?success=inserted");
            } else {
                header("location: ../view/ClienteCategoriaView.php?error=dbError");
            }
        } else {
            header("location: ../view/ClienteCategoriaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/ClienteCategoriaView.php?error=error");
    }
}
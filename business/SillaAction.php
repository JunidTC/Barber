<?php

include './SillaBusiness.php';

if (isset($_POST['update'])) {

    if (isset($_POST['sillaid']) && isset($_POST['sillaserie'])  && isset($_POST['sillamarca']) && isset($_POST['sillamodelo']) && isset($_POST['sillapreciocompra'])  ) {
        $serie = $_POST['sillaserie'];
        $marca = $_POST['sillamarca'];
        $modelo = $_POST['sillamodelo'];
        $preciocompra = $_POST['sillapreciocompra'];
        $activo = isset($_POST['sillaactivo']) ? 1 : 0; // si el check fue marcado, será 1, caso 
        $id = $_POST['sillaid'] ;
       
        
        if (strlen($serie ) > 0 && strlen($marca) > 0 && strlen($modelo) > 0  && strlen($preciocompra) > 0 ) {

            $silla = new Silla($id, $serie ,  $marca , $modelo, $preciocompra, 1 );

            $sillaBusiness = new SillaBusiness();

            $result = $sillaBusiness->updateTBSilla($silla);

            if ($result == 1) {
                header("location: ../view/SillaView.php?success=updated");
            } else {
                header("location: ../view/SillaView.php?error=dbError");
            }
        } else {
            header("location: ../view/SillaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/SillaView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivados'])) {
    if (isset($_POST['sillaid']) && isset($_POST['sillaserie'])  && isset($_POST['sillamarca']) && isset($_POST['sillamodelo']) && isset($_POST['sillapreciocompra'])  ) {
        $serie = $_POST['sillaserie'];
        $marca = $_POST['sillamarca'];
        $modelo = $_POST['sillamodelo'];
        $preciocompra = $_POST['sillapreciocompra'];
        $activo = 1 ; // si el check fue marcado, será 1, caso 
        $id = $_POST['sillaid'] ;
        if(!isset($_POST['sillaactivo'])){
            $activo = 0;
        }
       
        
        if (strlen($serie ) > 0 && strlen($marca) > 0 && strlen($modelo) > 0  && strlen($preciocompra) > 0 ) {

            $silla = new Silla($id, $serie ,  $marca , $modelo, $preciocompra, $activo );

            $sillaBusiness = new SillaBusiness();

            $result = $sillaBusiness->updateTBSilla($silla);

            if ($result == 1) {
                header("location: ../view/SillaView.php?success=updated");
            } else {
                header("location: ../view/SillaView.php?error=dbError");
            }
        } else {
            header("location: ../view/SillaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/SillaView.php?error=dbError");
    }
}else if (isset($_POST['delete'])) {

    if (isset($_POST['sillaid'])) {

        $id = $_POST['sillaid'];

        $sillaBusiness = new SillaBusiness();
        $result = $sillaBusiness->deleteTBSilla($id);

        if ($result == 1) {
            header("location: ../view/SillaView.php?success=deleted");
        } else {
            header("location: ../view/SillaView.php?error=dbError");
        }
    } else {
        header("location: ../view/SillaView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar

    if (isset($_POST['sillaserie']) && isset($_POST['sillamarca']) && isset($_POST['sillamodelo'])  && isset($_POST['sillapreciocompra']) ) {
        //recibir valores y guardar en variables 
        $serie = $_POST['sillaserie'];
        $marca= $_POST['sillamarca'];
        $modelo = $_POST['sillamodelo'];
        $preciocompra = $_POST['sillapreciocompra'];
        
        //validando datos
        if (strlen($serie) > 0 && strlen($marca) > 0 && strlen($modelo) > 0  && strlen($preciocompra) > 0 ) {
                //creando objeto
             $silla = new Silla(0, $serie,  $marca , $modelo, $preciocompra,1);

                $sillaBusiness = new SillaBusiness();
    
                $result =  $sillaBusiness->insertTBSilla($silla);

                if ($result == 1) {
                    header("location: ../view/SillaView.php?success=inserted");
                } else {
                    header("location: ../view/SillaView.php?error=dbError");
                }
        } else {
            header("location: ../view/SillaView.php?error=emptyField");
        }
    } else {
        header("location: ../view/SillaView.php?error=error");
    }
}
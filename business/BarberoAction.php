<?php


include 'BarberoBusiness.php';



if (isset($_POST['update'])) {
   
    
    if(str_contains ( $_POST['barberocorreo'] , "@")&&str_contains ( $_POST['barberocorreo'] , ".com") ){
            
        if (isset($_POST['barberonombre'])  && isset($_POST['barberotelefono']) && isset($_POST['barberocorreo'])  && isset($_POST['barberoid'])) {
            $nombre = $_POST['barberonombre'];
            $telefono = $_POST['barberotelefono'];
            $correo =  $_POST['barberocorreo'];
            $id = $_POST['barberoid'];

              
            
            if (strlen($nombre) > 0  && strlen($telefono) > 0  && strlen($correo) > 0 ) {
                
                $barbero = new Barbero($id, $nombre,  $telefono, $correo, 1);
                $barberoBusiness = new BarberoBusiness();
          
                $result = $barberoBusiness->updateTBBarbero($barbero);


                if ($result == 1) {
                    header("location: ../view/BarberoView.php?success=updated");
                } else {
                    header("location: ../view/BarberoView.php?error=dbError");
                }
            } else {
                header("location: ../view/BarberoView.php?error=emptyField");
            }
        } 
    }else {
        header("location: ../view/BarberoView.php?error=dbError");
    }
} else if (isset($_POST['updateDesactivado'])) {
  
   
    if (isset($_POST['barberoid']) && isset($_POST['barberonombre']) && isset($_POST['barberotelefono']) && isset($_POST['barberocorreo'])) {
        
        $nombre = $_POST['barberonombre'];
        $telefono = $_POST['barberotelefono'];
        $correo =  $_POST['barberocorreo'];
        $activo =  1;// si el check fue marcado, será 1 
        $id = $_POST['barberoid'];


        if(!isset($_POST['barberoactivo'])){
            $activo = 0;
        }
        
        if (strlen($nombre) > 0  && strlen($telefono) > 0  && strlen($correo) > 0 ) {
            
            $barbero = new Barbero($id, $nombre,   $telefono, $correo, $activo);
            
            $barberoBusiness = new BarberoBusiness();
            
            
            $result = $barberoBusiness->updateTBBarbero($barbero);

            if ($result == 1) {
                header("location: ../view/BarberoView.php?success=updated");
            } else {
                header("location: ../view/BarberoView.php?error=dbError");
            }
        } else {
            header("location: ../view/BarberoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/BarberoView.php?error=dbError");
    }
} else if (isset($_POST['delete'])) {

    if (isset($_POST['barberoid'])) {

        $id = $_POST['barberoid'];

        $barberoBusiness = new BarberoBusiness();
        $result = $barberoBusiness->deleteTBBarbero($id);

        if ($result == 1) {
            header("location: ../view/BarberoView.php?success=deleted");
        } else {
            header("location: ../view/BarberoView.php?error=dbError");
        }
    } else {
        header("location: ../view/BarberoView.php?error=error");
    }
} else if (isset($_POST['create'])) { //insertar
  
   
    if (isset($_POST['barberonombre'])  && isset($_POST['barberotelefono'])  && isset($_POST['barberocorreo'])) {
        //recibir valores y guardar en variables 
        $nombre = $_POST['barberonombre'];
        $telefono = $_POST['barberotelefono'];
        $correo = $_POST['barberocorreo'];

      

        //validando datos
        if (strlen($nombre) > 0  && strlen($telefono) > 0  && strlen($correo) > 0 ) {
            //creando objeto
            $barbero = new Barbero(0, $nombre, $telefono, $correo, 1);

            $barberoBusiness = new BarberoBusiness();

            $result =  $barberoBusiness->insertTBBarbero($barbero);

            if ($result == 1) {
                header("location: ../view/BarberoView.php?success=inserted");
            } else {
                header("location: ../view/BarberoView.php?error=dbError");
            }
        } else {
            header("location: ../view/BarberoView.php?error=emptyField");
        }
    } else {
        header("location: ../view/BarberoView.php?error=error");
    }
}

?>
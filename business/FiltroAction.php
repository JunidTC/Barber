<?php 
include 'FiltroBusiness.php';

class Buscador
{

  public function __construct(){
  }

  public function buscar($columna1, $columna2, $tabla,$dato){

  
    if (!isset($dato)){
      $dato = '';
    }
    if (!empty($dato)) {
    
      $filtroBusiness = new FiltroBusiness();
      $dato = $filtroBusiness->getDatosFiltro($columna1, $columna2, $tabla,$dato);
       // echo $dato;
      }

      return $dato;
  }
}
  
 if(isset($_POST['tabla']) && isset($_POST['buscar']) && isset($_POST['column1']) && isset($_POST['column2'])){

  $buscador = new Buscador();
    $resultado = $buscador-> buscar($_POST['column1'], $_POST['column2'],$_POST['tabla'],$_POST['buscar']);
    echo $resultado;

}

 ?>
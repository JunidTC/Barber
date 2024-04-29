<?php 


include_once 'Data.php';


class FiltroData extends Data{

    public function getDatosFiltro($columna1, $columna2, $tabla,$dato){
    	$conn = mysqli_connect($this->server, $this->user, $this->password, $this->db);
        $conn->set_charset('utf8');
        $akeyword = explode(" ", $dato);
		
     	 $query = "SELECT * FROM  $tabla WHERE $columna1 Like LOWER('%" . $akeyword[0] . "%') OR $columna2 Like LOWER('%" . $akeyword[0] . "%')";

	     for ($i = 1; $i < count($akeyword); $i++) {
	        if (!empty($akeyword[$i])) {

	          $query .= " OR $columna1 Like LOWER '%" . $akeyword[$i] . "%' 0R $columna2 Like LOWER '%" . $akeyword[$i] . "%'";
	        }
	      }

	     $result = mysqli_query($conn , $query);
      	 $numero = mysqli_num_rows($result);

      	 $buscador = new FiltroData();
      	 $html = '';
      	 if (mysqli_num_rows($result) > 0 && $dato != '') {
        $row_count = 0;
        $html .= "<br>Resultados encontrados:<b> " . $numero . "</b>";
        $html .= "<br><br><table border=1>
			    <thead>
			    <tr>
			    <th> # </th>
			    <th> Columna 1 </th>
			    <th> Columna 2 </th>
			    </tr>
			    </thead>";
			        while ($row = $result->fetch_assoc()) {
			          $row_count++;
			          $html .=  "<tr>
			     <td>" . $row_count . "</td>
			     <td>" . $buscador->resaltar_frase($row[$columna1], $dato) . "</td>
			     <td>" .  $buscador->resaltar_frase($row[$columna2], $dato) . "</td>
			     </tr>";
        }
        $html .=  "</table>";
      }else{
		$html = "";
	  }

      	 return $html;
    }

    
    public function resaltar_frase($string, $frase, $taga = '<b>', $tagb = '</b>'){
	    return ($string !== '' && $frase !== '')
	      ? preg_replace('/(' . preg_quote($frase, '/') . ')/i' . ('true' ? 'u' : ''), $taga . '\\1' . $tagb, $string)
	      : $string;
  	}
}



?>
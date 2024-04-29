<?php
include '../business/ServicioBusiness.php';
include '../business/TarifaBusiness.php';
$servicioBusiness2 = new ServicioBusiness();
$desactivados = $servicioBusiness2->getAllTBServicioDesactivado();

$tarifaBusiness = new TarifaBusiness();
$tarifas = $tarifaBusiness->getAllTBTarifas();


$servicioBusiness = new ServicioBusiness();
$servicios = $servicioBusiness->getAllTBServicios();
echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Servicio CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Servicio CRUD</h1>

</head>

<body>

    <form method="POST" action="../business/ServicioAction.php">
        <tr>  
            <th>Nombre</th>
            <td><input  type="text" name="servicionombre" id="servicionombre" onkeypress="return soloLetras(event)" placeholder="Nombre" /></td>
            <th>Descripción</th>
            <td><textarea  name="serviciodescripcion" id="serviciodescripcion" placeholder="Escribe una Descripción"></textarea></td>
            <th>Tarifa</th>
            <td> <select name="tarifas[tarifaId]" id="tarifa">
                    <option selected value=""> --Seleccione una tarifa-- </option>
                    <?php
                    foreach ($tarifas as $tarifa) { ?>

                        <option value="<?php echo $tarifa->getIdtarifa(); ?>">
                            <?php echo $tarifa->getMonto()   ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <th>Duracion</th>
            <td> <select name="servicioDuracion" id="servicioDuracion">
                    <option selected value=""> --Seleccione duracion-- </option>
                    <option value="30"> 30 minutos </option>
                    <option value="1"> 1 hora </option>
                </select>
            </td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbservicio', 'tbservicionombre','tbserviciodescripcion');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tarifa</th>
                <th>Duracion</th>
            </tr>

            <?php
            $servicioBusiness = new ServicioBusiness();
            $servicios = $servicioBusiness->getAllTBServicios();
            foreach ($servicios as $current) {
                echo '<form method="post" action="../business/ServicioAction.php">';
                echo '<input type="hidden" name="servicioid" value="' . $current->getIdServicio() . '">';
                echo '<td><input type="hidden"  name="tarifaId" value="' . $current->getTarifaId() . '"/></td>';
                echo '<tr>';
                echo '<td><input type="text" name="servicionombre" onkeypress="return soloLetras(event)" value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="text" name="serviciodescripcion" value="' . $current->getDescripcion() . '"/></td>';
               // echo '<td><input type="text" readonly value="' .'₡' . $tarifa = $tarifaBusiness->getTBTarifaById($current->getTarifaId())->getMonto() . '"/></td>';
                ?>
                <td> <select name="tarifas[tarifaId]" id="tarifa">
                    <option selected value="<?php echo $tarifaBusiness->getTBTarifaById($current->getTarifaId())->getIdTarifa() ?>"> <?php echo $tarifaBusiness->getTBTarifaById($current->getTarifaId())->getMonto() ?></option>
                    <?php
                    foreach ($tarifas as $tarifa) { ?>
                        <option value="<?php echo $tarifa->getIdtarifa(); ?>">
                            <?php echo $tarifa->getMonto()   ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <?php
                if ($current->getDuracion() === "30" ) {
                echo '<td><select name="servicioDuracion" id="servicioDuracion">'
                .'<option selected  value="' . $current->getDuracion() .'">'.$current->getDuracion() .' minutos</option>'
                .'<option value="1"> 1 hora </option>'
                .'</select></td>';
                }else if ($current->getDuracion() === "0" ){
                    echo '<td><select name="servicioDuracion" id="servicioDuracion">'
                    .'<option selected  value="' . $current->getDuracion() .'">'.$current->getDuracion() .'</option>'
                    .'<option value="30"> 30 minutos </option>'
                    .'<option value="1"> 1 hora </option>'
                    .'</select></td>';
                }else if ($current->getDuracion() === "1" ){
                    echo '<td><select name="servicioDuracion" id="servicioDuracion">'
                    .'<option selected  value="' . $current->getDuracion() .'">'.$current->getDuracion() .' hora</option>'
                    .'<option value="30"> 30 minutos </option>'
                    .'</select></td>';
                }
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>
            <tr>
                <td><a href="../Index.php">Volver al menú principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver servicios desactivados</label>
            </tr>
        </table>
    
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyField") {
                echo '<p style="color: red">Campo(s) vacio(s)</p>';
            } else if ($_GET['error'] == "dbError") {
                echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
            }
        } else if (isset($_GET['success'])) {
            echo '<p style="color: green">Transacción realizada</p>';
            echo '<br>';
        }
        ?>
    </section>

    <script type="text/javascript">
            function displayForm(c){
                if(c.value == "2"){
                    jQuery('#desactivoForm').toggle('show');
                }
                if(c.value == "1"){
                    jQuery('#desactivoForm').hidden();
                }
            }
    </script>


<div style="display:none" id="desactivoForm">
    <?php

        if(!empty($desactivados)){
    ?>
        <table>
            <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Tarifa</th>
                <th>Duracion</th>
                <th>Activo</th>
            </tr>

            <?php

            echo '<h1>Servicios Desactivados</h1>';
            foreach ($desactivados as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/ServicioAction.php">';
                echo '<input type="hidden" name="servicioid" value="' . $current->getIdServicio() . '">';
                echo '<tr>';
                echo '<td><input type="text" readonly="readonly" name="servicionombre" value="' . $current->getNombre() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="serviciodescripcion" value="' . $current->getDescripcion() . '"/></td>';
                echo '<td><input type="text" readonly value="' . $tarifa = $tarifaBusiness->getTBTarifaById($current->getTarifaId())->getMonto() . '"/></td>';
                
                if ($current->getDuracion() === "30" ) {
                    echo '<td><input type="text" readonly="readonly" name="servicioDuracion" value="' . $current->getDuracion() . '"/></td>';
                }else if ($current->getDuracion() === "0" ){
                    echo '<td><input type="text" readonly="readonly" name="servicioDuracion" value="' . $current->getDuracion() . '"/></td>';
                }else if ($current->getDuracion() === "1" ){
                    echo '<td><input type="text" readonly="readonly" name="servicioDuracion" value="' . $current->getDuracion() . '"/></td>';
                }
                echo '<td><input type="checkbox"  name="servicioactivo" value="' . $current->getActivo() . '"/></td>';
                echo '<td><input type="hidden"  name="tarifaId" value="' . $current->getTarifaId() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';
                echo '</tr>';
                echo '</form>';
            }
        }else{
            echo '<h1>No hay servicios desactivados</h1>';
        }
        ?>
        </table>
        <?php
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyField") {
                    echo '<p style="color: red">Campo(s) vacio(s)</p>';
                } else if ($_GET['error'] == "dbError") {
                    echo '<center><p style="color: red">Error al procesar la transacción</p></center>';
                }
            } else if (isset($_GET['success'])) {
                echo '<p style="color: green">Transacción realizada</p>';
                echo '<br>';
            }
        ?>
    </div>

    <footer>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click', '#delete', function() {
            var resultado = confirm('¿Está seguro que desea eliminar este servicio? (Todas las subcategorias enlazadas serán eliminadas)');
            if (!resultado) {
                return false;
            }
        });
    </script>

    <script type="text/javascript">
        function limpiar() {
            $("#datos_buscador").empty();
        }

        function buscar_ahora(dato, tb, col1, col2) {

            $.ajax({
                data: 'buscar=' + dato + "&tabla=" + tb + "&column1=" + col1 + "&column2=" + col2,
                type: "POST",
                url: "../business/FiltroAction.php",
                success: function(data) {

                    $("#datos_buscador").empty().append(data);

                    // document.getElementById("datos_buscador").innerHTML = Data;
                }
            });
        }
    </script>

<script>
        // script para obtener solo letras de un input 

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";

            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }

            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }
    </script>

</body>

</html>
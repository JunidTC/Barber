<?php
include '../business/ClienteTipoBusiness.php';
$clienteTipoBusiness2 = new ClienteTipoBusiness();
$desactivado = $clienteTipoBusiness2->getAllTBClienteTipoDesactivado();
echo gethostname();
?>

<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ClienteTipo CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>ClienteTipo CRUD</h1>

</head>

<body>

    <form method="POST" enctype="multipart/form-Data" action="../business/ClienteTipoAction.php">
      
        <tr>
            <th>Periodicidad</th>
            <td><input  type="number" name="clientetipoperiodicidad" id="clientetipoperiodicidad" placeholder="Periodicidad" /></td>
            <th>Cancelación</th>
            <td><input  type="number" name="clientetipocancelacion" id="clientetipocancelacion" placeholder="Cancelación" /></td>
            <th>Ingreso Mensual</th>
            <td><input  type="number" name="clientetipoingresomensual" id="clientetipoingresomensual" placeholder="Ingreso" /></td>
            <th>Puntaje</th>
            <td><input  type="number" name="clientetipopuntaje" id="clientetipopuntaje" placeholder="Puntaje" /></td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbclientetipo', 'tbclientetipoperiodicidad','tbclientetipopuntaje');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Periodicidad</th>
                <th>Cancelación</th>
                <th>Ingreso Mensual</th>
                <th>Puntaje</th>
            </tr>

            <?php
            $clienteTipoBusiness = new ClienteTipoBusiness();
            $clientesTipo = $clienteTipoBusiness->getAllTBClienteTipo();
            
            foreach ($clientesTipo as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/ClienteTipoAction.php">';
                echo '<input type="hidden" name="clientetipoid" value="' . $current->getClienteTipoId() . '">';
                echo '<tr>';
                echo '<td><input type="number" name="clientetipoperiodicidad" value="' . $current->getPeriodicidad() . '"/></td>';
                echo '<td><input type="number" name="clientetipocancelacion" value="' . $current->getCancelacion() . '"/></td>';
                echo '<td><input type="text" name="clientetipoingresomensual" value="' .'₡'. $current->getIngreso() . '"/></td>';
                echo '<td><input type="number" name="clientetipopuntaje" value="' . $current->getPuntaje() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al menu principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver clientes tipos desactivados</label><br>
                <td>
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
                </td>
            </tr>
        </table>
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

        if(!empty($desactivado)){
    ?> 
        <table>
            <tr>
                <th>Periodicidad</th>
                <th>Cancelación</th>
                <th>Ingreso Mensual</th>
                <th>Puntaje</th>
                <th>Activo</th>
            </tr>

            <?php
            echo '<h1>Clientes tipo desactivados</h1>';
            
            foreach ($desactivado as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/ClienteTipoAction.php">';
                echo '<input type="hidden" name="clientetipoid" value="' . $current->getClienteTipoId() . '">';
                echo '<tr>';
                echo '<td><input type="number" readonly="readonly" name="clientetipoperiodicidad" value="' . $current->getPeriodicidad() . '"/></td>';
                echo '<td><input type="number" readonly="readonly" name="clientetipocancelacion" value="' . $current->getCancelacion() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="clientetipoingresomensual" value="' .'₡'. $current->getIngreso() . '"/></td>';
                echo '<td><input type="number" readonly="readonly" name="clientetipopuntaje" value="' . $current->getPuntaje() . '"/></td>';
                echo '<td><input type="checkbox" name="clientetipoactivo" value="' . $current->getActivo() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';
                 
                echo '</tr>';
                echo '</form>';
            }
            }else{
                echo '<h1>No hay tipo de clientes desactivados</h1>';
            }
            ?>

            <tr>
               <td>
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
                </td>
            </tr>
        </table>
        </div>

    <footer>
    </footer>

    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click', '#delete', function() {
            var resultado = confirm('¿Está seguro que desea eliminar esta categoría? (Todas las subcategorias enlazadas serán eliminadas)');
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

</body>

</html>
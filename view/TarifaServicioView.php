<?php
include '../business/TarifaBusiness.php';
include '../business/LogicBusiness/Funciones.php';
$tarifaBusiness2 = new TarifaBusiness();
$desactivados =  $tarifaBusiness2->getAllTBTarifaDesactivada();
$funciones = new Funciones();
echo gethostname();
?>
<!DOCTYPE html>



<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Tarifa Servicios CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Tarifa Servicios CRUD</h1>

</head>

<body>

    <form method="POST" enctype="multipart/form-Data" action="../business/TarifaAction.php">
        <tr>
            <label for="">Fecha</label>
            <input type="date"  name=" tarifafecha" max="<?= date('Y-m-d'); ?>">
            <label for="">Tarifa</label>
            <td><input  type="number" name="tarifamonto" id="tarifamonto" placeholder="Monto" /></td>
            <td><input type="submit" onclick="validarFecha()" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbserviciotarifa', 'tbserviciotarifafechaactualizada','tbserviciotarifamonto');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Monto</th>
            </tr>

            <?php
            $tarifaBusiness = new TarifaBusiness();
            $tarifas =  $tarifaBusiness->getAllTBTarifas();
            foreach ($tarifas as $current) {
                echo '<form method="post" action="../business/TarifaAction.php">';
                echo '<input type="hidden" name="tarifaid" value="' . $current->getIdTarifa() . '">';
                echo '<tr>';
                echo '<input type="hidden"  name="tarifafecha" value="' . date('Y-m-d') . '"/>';
                echo '<td><input type="text" name="tarifamonto" value="' . '₡' . $current->getMonto() . '"/></td>';

                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';

                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al menú principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver tarifas desactivadas</label><br>
                
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
        function displayForm(c) {
            if (c.value == "2") {
                jQuery('#desactivoForm').toggle('show');
            }
            if (c.value == "1") {
                jQuery('#desactivoForm').hidden();
            }
        }
    </script>

    <div style="display:none" id="desactivoForm">
        <?php

        if (!empty($desactivados)) {
        ?>
            <table>
                <tr>
                    <th>Fecha de modificación</th>
                    <th>Monto</th>
                    <th>Activo</th>
                </tr>

            <?php
            echo '<h1>Tarifas desactivadas</h1>';
            foreach ($desactivados as $current) {
                echo '<form method="post" onclicenctype="multipart/form-Data" action="../business/TarifaAction.php">';
                echo '<input type="hidden" name="tarifaid" value="' . $current->getIdTarifa() . '">';
                echo '<tr>';
                echo '<td><input type="date" readonly="readonly" name="tarifafecha" value="' . $current->getFechaModificada() . '"/></td>';
                echo '<td><input type="text" readonly="readonly" name="tarifamonto" value="' . '₡' . $current->getMonto() . '"/></td>';
                echo '<td><input type="checkbox" name="tarifaactivo" value="' . $current->getActivo() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';
                echo '</tr>';
                echo '</form>';
            }
        } else {
            echo '<h1>No hay tarifas desactivadas</h1>';
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
            var resultado = confirm('¿Está seguro que desea eliminar esta tarifa? (Todas las subcategorias enlazadas serán eliminadas)');
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
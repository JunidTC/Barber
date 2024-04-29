<?php
include '../business/ImpuestoVentaBusiness.php';
$impuestoVentaBusiness2 = new ImpuestoVentaBusiness();
$desactivado =  $impuestoVentaBusiness2->getAllTBImpuestoVentaDesactivado();
echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>ImpuestoVenta CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>ImpuestoVenta CRUD</h1>
</head>

<body>

    <form method="POST" enctype="multipart/form-data" action="../business/ImpuestoVentaAction.php">
        <tr>
            <th>Porcentaje del impuesto</th>
            <td><input  type="number" name="impuestoventaporcentaje" id="impuestoventaporcentaje" placeholder="Porcentaje del impuesto" /></td>
            <th>Fecha</th>
            <td><input  type="date" max="<?= date('Y-m-d'); ?>" name="impuestoventafechaactualizacion" id="impuestoventafechaactualizacion" placeholder="Fecha de actualización" /></td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbimpuestoventa', 'tbimpuestoventaporcentaje','tbimpuestoventafechaactualizacion');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Porcentaje del impuesto</th>
            </tr>

            <?php
            $impuestoVentaBusiness = new ImpuestoVentaBusiness();
            $impuestoventas =  $impuestoVentaBusiness->getAllTBImpuestoVentas();
            foreach ($impuestoventas as $current) {
                echo '<form method="post" onclicenctype="multipart/form-data" action="../business/ImpuestoVentaAction.php">';
                echo '<input type="hidden" name="impuestoventaid" value="' . $current->getIdimpuestoventa() . '">';
                echo '<tr>';
                echo '<td><input type="text" name="impuestoventaporcentaje" value="' . '%' . $current->getPorcentaje() . '"/></td>';
                echo '<td><input type="hidden" name="impuestoventafechaactualizacion" value="' . date('Y-m-d') . '"/></td>';

                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';

                echo '</tr>';
                echo '</form>';
            }
            ?>

            <tr>
                <td><a href="../Index.php">Volver al inicio</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver impuestos de venta desactivados</label><br>

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

        if (!empty($desactivado)) {
        ?>
            <table>
                <tr>
                    <th>Porcentaje del impuesto</th>
                    <th>Fecha de actualización</th>
                    <th>Activo</th>
                </tr>

            <?php
            echo '<h1>Impuestos de venta desactivados</h1>';
            foreach ($desactivado as $current) {
                echo '<form method="post" onclicenctype="multipart/form-data" action="../business/ImpuestoVentaAction.php">';
                echo '<input type="hidden" name="impuestoventaid" value="' . $current->getIdimpuestoventa() . '">';
                echo '<tr>';
                echo '<td><input type="text" readonly="readonly" name="impuestoventaporcentaje" value="' . '%' . $current->getPorcentaje() . '"/></td>';
                echo '<td><input type="date" readonly="readonly" name="impuestoventafechaactualizacion" value="' . $current->getFechaActualizacion() . '"/></td>';
                echo '<td><input type="checkbox" name="impuestoventaactivo" value="' . $current->getActivo() . '"></td>';
                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="update"/></td>';
                echo '</tr>';
                echo '</form>';
            }
        } else {
            echo '<h1>No hay impuestos de venta desactivados</h1>';
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
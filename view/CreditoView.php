<?php
include '../business/CreditoBusiness.php';
include '../business/ClienteBusiness.php';
include '../business/FacturaBusiness.php';

include '../business/LogicBusiness/Funciones.php';
$logicBusiness = new Funciones();
$facturaBusiness = new FacturaBusiness();
$creditoBusiness = new CreditoBusiness();
$creditos = $creditoBusiness->getAllTBCreditos();
$clienteBusiness = new ClienteBusiness();
$clientes = $clienteBusiness->getAllTBCliente();
$fechaCreacion = $logicBusiness->fechaActual();

echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Credito CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Credito CRUD</h1>
   </head>

<body>

    <div>
        <label>Palabra a buscar</label>
        <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbcredito', 'tbcreditofacturaid','tbcreditofechalimite');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">
    </div>
    <div id="datos_buscador"></div>
    <section id="form">
        <table>
            <tr>
                <th>Cliente</th>
                <th> ID de la Factura</th>
                <th>fecha de Factura</th>
                <th>Fecha Limite</th>
                <th>Monto crédito</th>
            </tr>

            <?php

            foreach ($creditos as $current) {
                echo '<form method="post" action="../business/AbonoAction.php">';
                echo '<input type="hidden" name="creditoId" value="' . $current->getCreditoId() . '">';
                echo '<tr>';
                echo '<td><input readonly type="text"  value="' . $current->getNombreCliente() . '"/></td>';
                echo '<td><input readonly type="text" name="facturaId" value="' . $current->getFacturaId() . '"/></td>';
                echo '<td><input readonly type="text" name="fechaFactura" value="' . $current->getFechaFactura() . '"/></td>';
                echo '<td><input readonly type="text" name="fechaLimite"  value="' . $current->getFechaLimite() . '"/></td>';
                echo '<td><input readonly type="text" name="montoCredito" value="' . $current->getMontoCredito() . '"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '<td> <input type="number" name="abono" " value="" min="1" max = "' . $current->getMontoCredito() . '"/></td>';
                echo '<td><input type="hidden" name="abonoFecha" value="' . $fechaCreacion . '" /></td>';
                echo '<td><input type="submit" value="Abonar" name="create" /></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>
            <tr>
                <td><a href="../Index.php">Volver al inicio</a></td>

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
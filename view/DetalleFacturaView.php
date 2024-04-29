<?php
//* LOS INCLUDES DE LA CARPETA BUSINESS
include '../business/FacturaDetalleBusiness.php';
include '../business/ClienteBusiness.php';
include '../business/FacturaBusiness.php';
include '../business/ServicioBusiness.php';
include '../business/ImpuestoVentaBusiness.php';
include '../business/MetodoPagoBusiness.php';
include '../business/TarifaBusiness.php';
include '../business/CitaBusiness.php';
include '../business/LogicBusiness/Funciones.php';
include '../business/CreditoBusiness.php';


//* INSTACIA DE LAS CLASES DE BUSINESS 
$logicBusiness = new Funciones();
$facturaDetalleBusiness = new FacturaDetalleBusiness();
$clienteBusiness = new ClienteBusiness();
$facturaBusiness = new FacturaBusiness();
$servicioBusiness = new ServicioBusiness();
$impuestoVentaBusiness = new ImpuestoVentaBusiness();
$metodoPagoBusiness = new MetodoPagoBusiness();
$tarifaBusiness = new TarifaBusiness();
$citaBusiness = new CitaBusiness();
$creditoBusiness = new CreditoBusiness();

//* OBTENCION DE LOS DATOS 
$tarifas = $tarifaBusiness->getAllTBTarifas();
$metodoPagos = $metodoPagoBusiness->getAllTBMetodoPagos();
$impuestoVentas = $impuestoVentaBusiness->getAllTBImpuestoVentas();
$clientes = $clienteBusiness->getAllTBCliente();
$facturas = $facturaBusiness->getAllTBFactura();
$facturaDetalles = $facturaDetalleBusiness->getAllTBDetalleFacturas();
$servicios = $servicioBusiness->getAllTBServicios();
$citas = $citaBusiness->getAllTBCitasAgrupadas();



//*DATOS NECESARIOS CALCULADOS PARA LA FACTURA
$fechaCreacion = $logicBusiness->fechaActual();

echo gethostname();
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Genera Factura </title>
    <link rel="icon" href="../resources/icons/NOT.png">
    <link rel="stylesheet" href="../resources/css/css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Factura CRUD</h1>
</head>

<body>
    <form method="POST" enctype="multipart/form-Data" action="../business/FacturaAction.php">
              
    <tr>
        <th>Servicio</th>
            <td>
                <select name="servicios[idServicio]" id="servicio">
                    <option selected value=""> --Seleccione el servicio -- </option>
                    <?php
                    foreach ($servicios as $servicio) { ?>
                        <option value="<?php echo $servicio->getIdServicio(); ?>">
                            <?php echo $servicio->getNombre()
                            ?>
                        </option>
                    <?php } ?>

                </select>
            </td>
            <th>Impuesto</th>
            <td> <select name="impuestoVentas[idimpuestoventa]" id="impuestoVenta">
                    <option selected value=""> -- Seleccione el impuesto -- </option>
                    <?php
                    foreach ($impuestoVentas as $impuestoVenta) { ?>
                        <option value="<?php echo $impuestoVenta->getIdImpuestoVenta(); ?>">
                            <?php echo $impuestoVenta->getPorcentaje() . "%"  ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <th>Cliente</th>
            <td> <select name="clientes[idcliente]" id="cliente">
                    <option selected value=""> -- Seleccione el cliente -- </option>
                    <?php
                    foreach ($citas as $cita) { ?>

                        <option value="<?php echo $cita->getClienteId(); ?>">
                            <?php echo $clienteBusiness->getTBClienteById($cita->getClienteId())->getNombre() .$clienteBusiness->getTBClienteById($cita->getClienteId())->getApellido() ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <th>Cantidad de servicios</th>
            <td><input required type="number" name="cantidadServicios" id="cantidadServicios" placeholder="Cantidad de servicios" min="1" /></td>
            <th>Fecha</th>
            <td><input readonly type="date" name="fecha" id="fecha" value="<?php echo $fechaCreacion; ?>" /></td>
            <th>Metodo de pago</th>  
            <td> <select onclick="displayForm(this)" name="metodoPagos[idmetodopago]" id="metodoPago">
                    <option  selected value=""> -- Seleccione el metodo de pago -- </option>
                    <?php
                    foreach ($metodoPagos as $metodoPago) { ?>

                        <option  value="<?php echo $metodoPago->getNombre() ?>">
                            <?php echo $nombre = $metodoPago->getNombre(); ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <div style="display: none;" id="credito">
              <td><input style="width: 110px; "  type="number" name="creditosDias" placeholder="plazo en dias" min="1" max="30" /></td>    
            </div>

            <td><input type="submit" value="Insertar" name="create" id="create" /></td>

        </tr>
    </form>
    <script type="text/javascript">

        function displayForm(select) {
            console.log(select.value);
            if (select.value == "credito") {
                document.getElementById('credito').style.display = 'block';
            } else {
                document.getElementById('credito').style.display = 'none';
            }
        }
    </script>

    <section style="width:auto; height:20px;" id="form">
        <table>
            <tr>
                <th>Cliente</th>
                <th>Fecha</th>
            </tr>
            <?php
            foreach ($facturaDetalles as $current) {


                echo '<form method="POST" id="form-manga" onclicenctype="multipart/form-Data" action="./InsertarNuevoServicio.php">';
                echo '<input type="hidden" name="idDetalleFactura" value="' . $current->getIdDetalleFactura() . '">';
                echo '<input type="hidden" name="idFactura" value="' . $facturaId= $current->getFacturaId() . '">';
                echo '<td><input readonly type="text" name="clienteNombre" value="' . $clienteBusiness->getTBClienteById($facturaBusiness->getFacturaById($current->getFacturaId())->getClienteId())->getNombre() . " " . $clienteBusiness->getTBClienteById($facturaBusiness->getFacturaById($current->getFacturaId())->getClienteId())->getApellido() . '"/></td>';
                echo '<td><input readonly type="date" name="fecha" value="' . $facturaBusiness->getFacturaById($current->getFacturaId())->getFecha() . '"/></td>';
                echo '<td><input type="submit" value="Ver detalle"  /></td>';
                echo '<td><input name="delete" type="submit" value="Borrar Factura"  /></td>';
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
            var resultado = confirm('¿Está seguro que desea eliminar esta categoría? (Si la factura tiene un credito asociado se eliminará)');
            if (!resultado) {
                return false;
            }
        });
    </script>

</body>

</html>
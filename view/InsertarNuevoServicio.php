<?php
//* LOS INCLUDES DE LA CARPETA BUSINESS
include '../business/FacturaDetalleBusiness.php';
include '../business/ClienteBusiness.php';
include '../business/FacturaBusiness.php';
include '../business/ServicioBusiness.php';
include '../business/ImpuestoVentaBusiness.php';
include '../business/MetodoPagoBusiness.php';
include '../business/TarifaBusiness.php';
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
$creditoBusiness = new CreditoBusiness();

//* OBTENCION DE LOS DATOS 
$tarifas = $tarifaBusiness->getAllTBTarifas();
$metodoPagos = $metodoPagoBusiness->getAllTBMetodoPagos();
$impuestoVentas = $impuestoVentaBusiness->getAllTBImpuestoVentas();
$clientes = $clienteBusiness->getAllTBCliente();
$facturas = $facturaBusiness->getAllTBFactura();
$servicios = $servicioBusiness->getAllTBServicios();

$facturaId = $_GET['facturaId'] ?? $_POST['idFactura'] ?? null;
$factura = $facturaBusiness->getFacturaById($facturaId);

$detalleFacturas = $facturaDetalleBusiness->getTBDetalleFacturasByFacturaId($facturaId);

if(isset($_POST['delete'])){
    if (isset($_POST['idFactura']) && isset($_POST['idDetalleFactura'])) {
        $facturaid = $_POST['idFactura'];
        $detalleFacturaBusiness = new FacturaDetalleBusiness();
        $creditoId = null;
        $credito = $creditoBusiness->getTBCreditoByIdFactura($facturaid);
        if($credito != null){
            $creditoId = $credito->getCreditoId();
        }
        $detallesFacturas = $facturaDetalleBusiness->getTBDetalleFacturasByFacturaId($facturaid);
        foreach($detallesFacturas as $detalleFactura){
            $result =$detalleFacturaBusiness->deleteTBDetalleTFactura($detalleFactura->getIdDetalleFactura());
        }
        if($creditoId != null){
            $result = $creditoBusiness->deleteTBCreditoDelete($creditoId);
        }
        $facturaBusiness = new FacturaBusiness();
        $result = $facturaBusiness->deleteTBFactura($facturaid);

        if ($result == 1) {
            header("location: ../view/DetalleFacturaView.php?success=deleted");
        } else {
            header("location: ../view/DetalleFacturaView.php?error=dbError");
        }
    } else {
        header("location: ../view/DetalleFacturaView.php?error=error");
    }
}

//*DATOS NECESARIOS CALCULADOS PARA LA FACTURA
$fechaCreacion = $logicBusiness->fechaActual();

echo gethostname();
?>
<!DOCTYPE html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Añadir servicios </title>
    <link rel="icon" href="../resources/icons/NOT.png">
    <link rel="stylesheet" href="../resources/css/css.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Añadir más servicios a la factura</h1>
</head>

<body>
    <form method="POST" enctype="multipart/form-Data" action="../business/AgregarServiciosAction.php">

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

            <th>Cantidad de servicios</th>
            <td><input type="number" name="cantidadServicios" id="cantidadServicios" placeholder="Cantidad de servicios" min="1" /></td>
            <td><input type="hidden" name="idFactura" value="<?php echo $facturaId ?>" /> </td>

            <td><input type="submit" value="Insertar" name="create" id="create" /></td>

        </tr>
    </form>
    <section style="width:auto; height:20px;" id="form">

        <div style="width: 360 ;">
            <label style="font-weight: bold; font-size: 18px;">FECHA:</label>
            <?php echo $facturaBusiness->getFacturaById($facturaId)->getFecha() ?>
            <br>
            <hr>
            <label style="font-weight: bold; font-size: 18px;">NOMBRE:</label>
            <?php echo $clienteBusiness->getTBClienteById($facturaBusiness->getFacturaById($facturaId)->getClienteId())->getNombre() . " " . $clienteBusiness->getTBClienteById($facturaBusiness->getFacturaById($facturaId)->getClienteId())->getApellido() ?>
            <br>
            <hr>
            <label style="font-weight: bold; font-size: 18px;">SUBTOTAL:</label>
            <?php echo  '₡' . $facturaBusiness->getFacturaById($facturaId)->getMonto()  ?>
            <br>
            <hr>
            <label style="font-weight: bold; font-size: 18px;">IMPUESTO:</label>
            <?php echo $impuestoVentaBusiness->getTBImpuestoVentaById($facturaBusiness->getFacturaById($facturaId)->getImpuestoVenta())->getPorcentaje() . "%" ?>
            <br>
            <hr>
            <label style="font-weight: bold; font-size: 18px;">TOTAL CON IMPUESTO:</label>
            <?php echo '₡' . $facturaBusiness->getFacturaById($facturaId)->getMontoTotal() ?>
            <br>
            <hr>

        </div>


        <table>
            <tr>
                <th>Servicio</th>
                <th>Cantidad de servicios</th>
            </tr>
            <?php
            foreach ($detalleFacturas as $current) {
                echo '<form method="POST" id="form-manga" onclicenctype="multipart/form-Data" action="../business/FacturaDetalleAction.php">';
                echo '<input type="hidden" name="idDetalleFactura" value="' . $current->getIdDetalleFactura() . '">';
                echo '<input type="hidden" name="idFactura" value="' . $current->getFacturaId() . '">';
                echo '<td><input readonly type="text" name="servicioId" value="' . $servicioBusiness->getTBServicioById($current->getServicioId())->getNombre()  . '"/></td>';
                echo '<td><input readonly type="number" name="cantidadServicio" value="' . $current->getCantidadServicio() . '"/></td>';
                echo '</tr>';
                echo '</form>';
            }

            ?>
            <tr>
                <td><a href="DetalleFacturaView.php">Volver a facturas</a></td>
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

</body>

</html>
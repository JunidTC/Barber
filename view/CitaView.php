<?php
include '../business/ClienteBusiness.php';
include '../business/TarifaBusiness.php';
include '../business/BarberoBusiness.php';
include '../business/ServicioBusiness.php';
include '../business/LogicBusiness/Funciones.php';
$tarifaBusiness2 = new TarifaBusiness();
$barberoBusiness = new BarberoBusiness();
$clienteBusiness = new ClienteBusiness();
$servicioBusiness = new ServicioBusiness();
$servicios = $servicioBusiness->getAllTBServicios();
$clientes = $clienteBusiness->getAllTBCliente();
$tarifaBusiness = new TarifaBusiness();
$tarifas =  $tarifaBusiness->getAllTBTarifas();
$barberos = $barberoBusiness->getAllTBBarbero();
$funciones = new Funciones();
echo gethostname();

?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Cita</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Agendar Cita</h1>

</head>

<body>

    <form method="POST" enctype="multipart/form-Data" action="../business/CitaAction.php">
        <tr>
            <td> <label>Cliente:</label>
                <select name="clientes[idcliente]" id="cliente">
                    <option selected value=""> -- Seleccione el cliente -- </option>
                    <?php
                    foreach ($clientes as $cliente) { ?>

                        <option value="<?php echo $cliente->getId(); ?>">
                            <?php echo $cliente->getNombre() . " " . $cliente->getApellido() ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <td> <label>Barbero:</label>
                <select name="barberos[idbarbero]" id="barbero">
                    <option selected value=""> -- Seleccione el barbero -- </option>
                    <?php
                    foreach ($barberos as $barbero) { ?>

                        <option id="barbero" value="<?php echo $barbero->getBarberoId(); ?>">
                            <?php echo $barbero->getNombre() ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <td> <label>servicio:</label>
                <select name="servicios[idservicio]" id="servicio">
                    <option selected value=""> -- Seleccione el servicio -- </option>
                    <?php
                    foreach ($servicios as $servicio) { ?>

                        <option id="servicio" value="<?php echo $servicio->getIdServicio(); ?>">
                            <?php echo $servicio->getNombre() ?>
                        </option>
                    <?php } ?>
                </select>
            </td>

            <label for="">Fecha</label>
            <input type="date" name="citafecha" id="fecha" min="<?= date('Y-m-d'); ?>">

            <div id="horas" class="horas">
            </div>
            <div style="display: none;" id="credito">
                <td><input type="submit" name="create" value="Agendar Cita"></td>
            </div>

        </tr>
    </form>
    
    <button onclick="getValueInput(); mostrar(); " id="credito" > Buscar</button>
    <script type="text/javascript">
        function mostrar() {
            var x = document.getElementById('credito');
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
        }
    </script>
    <div>
        <input id="valueInput" type="hidden" value="">
    </div>
    <script>
        const getValueInput = () => {
            let inputValue = document.getElementById("fecha").value;
            document.getElementById("valueInput").value = inputValue;
            enviarValor();
        }

        function enviarValor() {
            var dato = $('#valueInput').val();
            var dato2 = document.getElementById("barbero").value;
            var dato4 = document.getElementById("servicio").value;
            var dato3 = $('#fecha').val();
            $.ajax({
                data: {
                    "dato": dato,
                    "dato2": dato2,
                    "dato3": dato3,
                    "dato4": dato4
                },
                url: "../business/ObtenerDia.php",
                type: "post",
                success: function(response) {
                    document.getElementById("horas").innerHTML = response;
                
                }
            });
        }
    </script>

    <section id="form">

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
    <a href="../Index.php">Volver al menú principal</a>
    <script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script type="text/javascript">
        $(document).on('click', '#delete', function() {
            var resultado = confirm('¿Está seguro que desea eliminar esta cita? (Todas las subcategorias enlazadas serán eliminadas)');
            if (!resultado) {
                return false;
            }
        });
    </script>
</body>

</html>
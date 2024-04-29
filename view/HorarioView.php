<?php
include '../business/HorarioBusiness.php';
include '../business/BarberoBusiness.php';

$horarioBusiness = new HorarioBusiness();
$horarios = $horarioBusiness->getAllTBHorarios();

$barberoBusiness = new BarberoBusiness();
$barberos = $barberoBusiness->getAllTBBarbero();

echo gethostname();
?>
<!DOCTYPE html>

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Horario CRUD</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <style>
        h1 {
            text-align: center;
        }
    </style>
    <h1>Horario CRUD</h1>

</head>

<body>

    <form method="POST" action="../business/HorarioAction.php">
        <tr> 
            <th>Barbero</th>
            <td> <select name="barberos[barberoId]" id="barbero">
                    <option selected value=""> --Seleccione un barbero-- </option>
                    <?php
                    foreach ($barberos as $barbero) { ?>
                        <option value="<?php echo $barbero->getBarberoId(); ?>">
                            <?php echo $barbero->getNombre()   ?>
                        </option>
                    <?php } ?>
                </select>
            </td>
            <th>Dia</th>
            <td> <select name="fecha" id="fecha">
                    <option selected value=""> --Seleccione dia-- </option>
                    <option value="1"> Lunes </option>
                    <option value="2"> Martes </option>
                    <option value="3"> Miercoles </option>
                    <option value="4"> Jueves </option>
                    <option value="5"> Viernes </option>
                    <option value="6"> Sabado </option>
                    <option value="7"> Domingo </option>
                </select>
            </td>
            <th>Hora Inicio</th>
            <td><input  type="time" name="horaInicial" id="horaInicial" value="08:00:00" "  /></td>
            <th>Hora Final</th>
            <td><input  type="time" name="horaFinal" id="horaFinal" value="18:00:00" /></td>
            <td><input type="submit" value="Insertar" name="create" id="create" /></td>
        </tr>
    </form>
    <div>
        <div>
            <label>Palabra a buscar</label>
            <input onkeypress="buscar_ahora($('#buscar1').val(), 'tbservicio', 'tbserviciosnombre','tbserviciosdescripcion');" onkeydown="limpiar();" onchange="limpiar();" type="text" id="buscar1" name="buscar1" placeholder="Palabra a buscar">

        </div>
        <div id="datos_buscador"></div>
    </div>
    <section id="form">
        <table>
            <tr>
                <th>Nombre barbero</th>
                <th>Dia</th>
                <th>Hora Inicio</th>
                <th>Hora Final</th>
            </tr>

            <?php

            foreach ($horarios as $current) {
                echo '<form method="post" action="../business/HorarioAction.php">';
                echo '<input type="hidden" name="horarioId" value="' . $current->getHorarioId() . '">';
                echo '<td><input type="hidden" name="fecha" value="' . $current->getFecha() . '"/></td>';
                echo '<tr>';
                echo '<input type="hidden" name="barberoId" value="' . $barberoId= $current->getBarberoId() . '">';
                echo '<td><input readonly type="text" name="barbero" value="' . $barberoBusiness->getTBBarberoById($current->getBarberoId())->getNombre() . '"/></td>';
                if ($current->getFecha() === "1" ) {
                    echo '<td><input type="text" readonly="readonly" value="Lunes"/></td>';
                }else if ($current->getFecha() === "2" ) {
                    echo '<td><input type="text" readonly="readonly" value="Martes"/></td>';
                }else if ($current->getFecha() === "3" ) {
                    echo '<td><input type="text" readonly="readonly" value="Miercoles"/></td>';;
                }else if ($current->getFecha() === "4" ) {
                    echo '<td><input type="text" readonly="readonly" value="Jueves"/></td>';
                }else if ($current->getFecha() === "5" ) {
                    echo '<td><input type="text" readonly="readonly" value="Viernes"/></td>';
                }else if ($current->getFecha() === "6" ) {
                    echo '<td><input type="text" readonly="readonly" value="Sabado"/></td>';
                }else if ($current->getFecha() === "7" ) {
                    echo '<td><input type="text" readonly="readonly" value="Domingo"/></td>';
                }
                echo '<td><input type="time"  name="horaInicial" value="' . $current->getFechaInicial() . '"/></td>';
                echo '<td><input type="time"  name="horaFinal" value="' . $current->getFechaFinal() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="update" id="update"/></td>';
                echo '<td><input type="submit" value="Eliminar" name="delete" id="delete"/></td>';
                echo '</tr>';
                echo '</form>';
            }
            ?>
            <tr>
                <td><a href="../Index.php">Volver al menú principal</a></td>
                <label><input type="radio" id="tablaDesactivos" value="2" name="formDesactivos" onClick="displayForm(this)"></input> Ver horarios desactivados</label>
            </tr>
        </table>
    
        <?php
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyField") {
                echo '<p style="color: red">Campo(s) vacio(s)</p>';
            } else if ($_GET['error'] == "error") {
                echo '<center><p style="color: red">No puedes modificar tu horario, ya tienes una cita ese dia !!</p></center>';
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
                <th>Nombre barbero</th>
                <th>Dia</th>
                <th>Hora Inicio</th>
                <th>Hora Final</th>
                <th>Activo</th>
            </tr>

            <?php
            echo '<h1>Horarios Desactivados</h1>';
            foreach ($horarios as $current) {
                echo '<form method="post" action="../business/HorarioAction.php">';
                echo '<input type="hidden" name="horarioId" value="' . $current->getHorarioId() . '">';
                echo '<td><input type="hidden" name="fecha" value="' . $current->getFecha() . '"/></td>';
                echo '<tr>';
                echo '<input type="hidden" name="barberoId" value="' . $barberoId= $current->getBarberoId() . '">';
                echo '<td><input readonly type="text" name="barbero" value="' . $barberoBusiness->getTBBarberoById($current->getBarberoId())->getNombre() . '"/></td>';
                if ($current->getFecha() === "1" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Lunes"/></td>';
                }else if ($current->getFecha() === "2" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Martes"/></td>';
                }else if ($current->getFecha() === "3" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Miercoles"/></td>';;
                }else if ($current->getFecha() === "4" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Jueves"/></td>';
                }else if ($current->getFecha() === "5" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Viernes"/></td>';
                }else if ($current->getFecha() === "6" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Sabado"/></td>';
                }else if ($current->getFecha() === "7" ) {
                    echo '<td><input type="text" readonly="readonly" name="fecha" value="Domingo"/></td>';
                }
                echo '<td><input readonly="readonly" type="time"  name="horaInicial" value="' . $current->getFechaInicial() . '"/></td>';
                echo '<td><input readonly="readonly" type="time"  name="horaFinal" value="' . $current->getFechaFinal() . '"/></td>';
                echo '<td><input type="submit" value="Actualizar" name="updateDesactivado" id="updateDesactivado"/></td>';
                echo '</tr>';
                echo '</form>';
            }
        }else{
            echo '<h1>No hay Horarios desactivados</h1>';
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